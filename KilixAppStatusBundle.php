<?php

namespace Kilix\AppStatusBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Kilix\AppStatusBundle\DependencyInjection\Compiler\AppStatusCompilerPass;

class KilixAppStatusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AppStatusCompilerPass());
    }
}
