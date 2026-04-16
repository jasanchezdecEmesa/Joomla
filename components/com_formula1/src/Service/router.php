<?php
namespace Alumno\Component\Formula1\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterInterface;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\Database\DatabaseInterface;

class Router implements RouterInterface
{
    public function __construct($application, $menu, CategoryFactoryInterface $categoryFactory = null, DatabaseInterface $db = null)
    {
    }

    public function preprocess($query)
    {
        return $query;
    }

    public function build(&$query)
    {
        return [];
    }

    public function parse(&$segments)
    {
        return [];
    }
}