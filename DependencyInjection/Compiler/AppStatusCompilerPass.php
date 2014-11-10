<?php

namespace Kilix\AppStatusBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AppStatusCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('acme_mailer.transport_chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'kilix_app_status.status_collector'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'kilix_app_status.status'
        );

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addStatus',
                array(new Reference($id))
            );
        }
    }
}
