<?php

namespace Alumno\Component\Formula1\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class DriverModel extends AdminModel
{
    public function getTable($name = 'Driver', $prefix = '', $options = [])
    {
        return $this->getMVCFactory()->createTable($name, $prefix, $options);
    }

    public function getForm($data = [], $loadData = true)
    {
        $form = $this->loadForm(
            'com_formula1.driver',
            'driver',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_formula1.edit.driver.data', []);

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
}