<?php

namespace Kilix\AppStatusBundle\Status;

interface StatusInterface
{

    /**
     * @return String a string representing the name of your tested status app part
     */
    public function getName();

    /**
     * @return boolean a boolean representing the status of your tested app part
     */
    public function getStatus();

}
