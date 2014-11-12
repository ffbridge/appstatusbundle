<?php

namespace Kilix\AppStatusBundle\Tests\TestBundle\Service;

use Kilix\AppStatusBundle\Status\StatusInterface;

class HelloStatus implements StatusInterface
{

    public function getStatus()
    {
        /**
         * my tests ...
         */

        return true;
    }   

    public function getName()
    {
        return 'test_db';
    }

}