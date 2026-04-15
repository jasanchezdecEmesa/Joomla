<?php

namespace Alumno\Component\Formula1\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class TeamsController extends BaseController
{
    public function delete()
    {
        $app = Factory::getApplication();
        $id = $app->input->getInt('id');

        if ($id > 0) {
            $model = $this->getModel('Team');
            $pks = [$id];
            $model->delete($pks);
        }

        $this->setRedirect('index.php?option=com_formula1&view=teams');
    }
}