<?php

namespace Alumno\Component\Formula1\Site\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\Database\DatabaseAwareTrait;
use Psr\Container\ContainerInterface;

class Formula1Component extends MVCComponent implements RouterServiceInterface
{
    use RouterServiceTrait;
    use DatabaseAwareTrait;

    public function boot(ContainerInterface $container)
    {
    }
}