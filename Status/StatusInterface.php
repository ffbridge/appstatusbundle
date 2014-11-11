<?php

namespace Kilix\AppStatusBundle\Status;

interface StatusInterface
{
    /**
     * @return string 
     */
    public function getName();

    /**
     * @return mixed 
     */
    public function getStatus();
}
