<?php

namespace Kilix\AppStatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppStatusController extends Controller
{
    public function statusAction($attribute)
    {
        $response = new JsonResponse();
        $data = $this->get('kilix_app_status.status_collector')->collectStatuses();
        $response->setData($data);
        return $response;
    }
}
