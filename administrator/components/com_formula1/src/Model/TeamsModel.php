<?php

namespace Alumno\Component\Formula1\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class TeamsModel extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDatabase();

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__formula1_teams'))
            ->order($db->quoteName('name') . ' ASC');

        return $query;
    }
}