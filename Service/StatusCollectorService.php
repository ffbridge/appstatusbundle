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
            preg_match_all('/([A-Z](?=[a-z])[^A-Z\s_]*)|([A-Z]+(?![a-z]))|([a-z]+)/', $statusName, $matches);
            $statusName = '';
            foreach ($matches[0] as $index => $match) {
                if($index > 0) {
                    $statusName .= '_';
                }
                $statusName .= strtolower(trim($match,'_'));
            }
            
            $data[$statusName] = $status->getStatus();
        }

        return array('app' => $data);
    }
}