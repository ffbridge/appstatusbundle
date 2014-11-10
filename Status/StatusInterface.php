<?php

namespace Kilix\AppStatusBundle\Interface;


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
