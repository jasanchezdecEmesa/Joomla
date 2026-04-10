<?php

namespace Alumno\Component\Formula1\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class DriversModel extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDatabase();

        $query = $db->getQuery(true)
            ->select([
                $db->quoteName('d.id'),
                $db->quoteName('d.first_name'),
                $db->quoteName('d.last_name'),
                $db->quoteName('d.nationality'),
                $db->quoteName('d.number'),
                $db->quoteName('d.team_id'),
                $db->quoteName('t.name', 'team_name')
            ])
            ->from($db->quoteName('#__formula1_drivers', 'd'))
            ->join(
                'LEFT',
                $db->quoteName('#__formula1_teams', 't')
                . ' ON ' . $db->quoteName('d.team_id')
                . ' = ' . $db->quoteName('t.id')
            )
            ->order($db->quoteName('d.last_name') . ' ASC');

        return $query;
    }
}