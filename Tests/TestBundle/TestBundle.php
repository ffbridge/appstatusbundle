<?php

namespace Kilix\AppStatusBundle\Tests\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Kilix\AppStatusBundle\Tests\TestBundle\DependencyInjection\TestExtension;

class TestBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new TestExtension();
    }
}
