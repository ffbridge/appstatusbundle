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
    const KEYWORD_KO = 'KO';
    const KEYWORD_OK = 'OK';

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

    public function collectStatuses($attribute = 'all') 
    {

        if($attribute != 'all' && !empty($attribute) && is_string($attribute)) {
            if(isset($this->statuses[$attribute])) {
                $state = $this->statuses[$attribute]->getStatus();
                $state = $this->getKeywordStatus($state);

                return array(
                        'status' => ($state == self::KEYWORD_OK) ? self::STATUS_OK : self::STATUS_KO, 
                        'data' => array(
                            $attribute => $state
                        )
                    );
            } else {
                return array('status' => self::STATUS_NOT_FOUND);
            }
        }

        $appState = self::STATUS_OK;
        $data = array();
        foreach ($this->statuses as $statusName => $status) 
        {
            $state = $status->getStatus();
            $state = $this->getKeywordStatus($state);

            if($state == self::KEYWORD_KO) {
                $appState = self::STATUS_KO;
            }

            $data[$statusName] = $state;
        }

        return array(
            'status' => $appState,
            'data' => $data
        );
    }

    protected function getKeywordStatus($state)
    {
        return ($state) ? self::KEYWORD_OK : self::KEYWORD_KO;
    }
}