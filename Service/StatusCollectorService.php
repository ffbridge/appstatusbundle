<?php

namespace Kilix\AppStatusBundle\Service;

use Kilix\AppStatusBundle\Status\StatusInterface;

class StatusCollectorService 
{
    private $statuses;

    public function __construct()
    {
        $this->statuses = array();
    }

    public function addStatus(StatusInterface $status)
    {
        $this->statuses[] = $status;
    }

    public function collectStatuses() 
    {
        $data = array();
        foreach ($this->statuses as $status) 
        {
            $statusName = str_replace(" ", "", $status->getName());
            $statusName = preg_replace_callback(
                '([A-Z][a-z]+[^A-Z\s]*)', 
                function($match) {
                    return "_" . strtolower($match[0]);
                }
                , $statusName);
            $statusName = trim($statusName,'_');

            $data[$statusName] = $status->getStatus();
        }

        return array('app' => $data);
    }
}