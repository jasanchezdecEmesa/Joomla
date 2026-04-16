<?php

namespace Alumno\Component\Formula1\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;

class DriverController extends FormController
{
    protected $view_list = 'drivers';

    protected function allowAdd($data = [])
    {
        $user = Factory::getApplication()->getIdentity();
        return $user->authorise('core.create', 'com_formula1');
    }

    protected function allowEdit($data = [], $key = 'id')
    {
        $user = Factory::getApplication()->getIdentity();
        return $user->authorise('core.edit', 'com_formula1');
    }
}