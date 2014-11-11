<?php

namespace Kilix\AppStatusBundle\Tests\TestBundle\Service;

use Kilix\AppStatusBundle\Status\StatusInterface;

class HelloStatus implements StatusInterface
{

    public function getStatus()
    {
        return "OK";
    }   

    public function getName()
    {
        return 'HelloWorld';
    }

}