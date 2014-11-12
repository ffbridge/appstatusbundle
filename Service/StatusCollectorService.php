<?php

namespace Kilix\AppStatusBundle\Service;

use Kilix\AppStatusBundle\Status\StatusInterface;
use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;

class StatusCollectorService 
{
    private $statuses;

    const STATUS_OK = 0;
    const STATUS_KO = 1;
    const STATUS_NOT_FOUND = 2;

    public function __construct()
    {
        $this->statuses = array();
    }

    public function addStatus(StatusInterface $status)
    {
        preg_match_all('/([A-Z](?=[a-z])[^A-Z\s_]*)|([A-Z]+(?![a-z]))|([a-z]+)/', $statusName = str_replace(" ", "", $status->getName()), $matches);

        $statusName = '';
        foreach ($matches[0] as $index => $match) {
            if($index > 0) {
                $statusName .= '_';
            }
            $statusName .= strtolower(trim($match,'_'));
        }
        $this->statuses[$statusName] = $status;
    }

    public function collectStatuses($attribute = null) 
    {
        if(!empty($attribute) && is_string($attribute)) {
            if(isset($this->statuses[$attribute])) {
                $state = $this->statuses[$attribute]->getStatus();
                return array(
                        'status' => ($state) ? self::STATUS_OK : self::STATUS_KO, 
                        'data' => array(
                            $attribute => $state
                        )
                    );
            }
        } else {
            return array('status' => self::STATUS_NOT_FOUND);
        }

        $appStatus = self::STATUS_OK;
        $data = array();
        foreach ($this->statuses as $statusName => $status) 
        {   
            print_r($status);
            $state = $status->getStatus();
            if(!$state) {
                $appStatus = self::STATUS_KO;
            }
            $data[$statusName] = $state;
        }

        return array(
            'status' => $appStatus,
            'data' => $data
        );
    }
}