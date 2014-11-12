<?php

namespace Kilix\AppStatusBundle\Tests\TestBundle\Service;

use Kilix\AppStatusBundle\Status\StatusInterface;

class TestFailingStatus implements StatusInterface
{

    public function getStatus()
    {
        /**
         * my tests ...
         */

        return false;
    }   

    public function getName()
    {
        return 'test_failing';
    }

}