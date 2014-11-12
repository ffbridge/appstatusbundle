<?php

namespace Kilix\AppStatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Kilix\AppStatusBundle\Service\StatusCollectorService;

class AppStatusController extends Controller
{
    public function statusAction($attribute)
    {
        $response = new JsonResponse();
        $data = $this->get('kilix_app_status.status_collector')->collectStatuses($attribute);
        print_r($data);
    
        if ($data['status'] == StatusCollectorService::STATUS_NOT_FOUND) {
            return $response->setStatusCode(404)
                            ->setData('status not found');

        } else if ($data['status'] == StatusCollectorService::STATUS_KO) {
            return $response->setStatusCode(409)
                            ->setData($data['data']);

        } else if ($data['status'] == StatusCollectorService::STATUS_OK) {
            return $response->setData($data['data']);
        }
    }
}
