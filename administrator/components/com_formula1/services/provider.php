<?php

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory as ComponentDispatcherFactoryServiceProvider;
use Joomla\CMS\Extension\Service\Provider\MVCFactory as MVCFactoryServiceProvider;
use Joomla\CMS\Extension\Service\Provider\RouterFactory as RouterFactoryServiceProvider;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Alumno\Component\Formula1\Administrator\Extension\Formula1Component;

return new class implements ServiceProviderInterface {
    public function register(Container $container): void
    {
        $container->registerServiceProvider(new MVCFactoryServiceProvider('\\Alumno\\Component\\Formula1'));
        $container->registerServiceProvider(new ComponentDispatcherFactoryServiceProvider('\\Alumno\\Component\\Formula1'));
        $container->registerServiceProvider(new RouterFactoryServiceProvider('\\Alumno\\Component\\Formula1'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new Formula1Component($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));
                $component->setDatabase($container->get(DatabaseInterface::class));

                return $component;
            }
        );
    }
};