<?php

namespace Cmnty\PushBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class CmntyPushExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->handlePushServices($config['push_services'], $container);
    }

    private function handlePushServices(array $config, ContainerBuilder $container)
    {
        $serviceRegistry = $container->getDefinition('cmnty_push.service_registry');
        if ($config['google']['enabled']) {
            $google = $container->getDefinition('cmnty_push.service.google');
            $google->addArgument($config['google']['api_key']);

            $serviceRegistry->addMethodCall('addPushService', [$google]);
        }
        if ($config['mozilla']['enabled']) {
            $mozilla = $container->getDefinition('cmnty_push.service.mozilla');

            $serviceRegistry->addMethodCall('addPushService', [$mozilla]);
        }
    }
}
