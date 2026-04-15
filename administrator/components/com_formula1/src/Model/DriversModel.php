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
                $db->quoteName('d.picture'),
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
        
        $search = $this->getState('filter.search');
        $nationality = $this->getState('filter.nationality');
        // var_dump($nationality); die(); // Descomenta esto para probar

        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where($db->quoteName('d.id') . ' = ' . (int) substr($search, 3));
            } else {
                $search = $db->quote('%' . $db->escape($search, true) . '%');
                $query->where('(' . $db->quoteName('d.first_name') . ' LIKE ' . $search . 
                            ' OR ' . $db->quoteName('d.last_name') . ' LIKE ' . $search . ')');
            }
        }

        if (!empty($nationality)) {
            $query->where($db->quoteName('d.nationality') . ' = ' . $db->quote($db->escape($nationality)));
        }

        $query->order($db->quoteName('d.last_name') . ' ASC');

        return $query;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string');
        $this->setState('filter.search', trim($search));

        $nationality = $this->getUserStateFromRequest($this->context . '.filter.nationality', 'filter_nationality', '', 'string');
        $this->setState('filter.nationality', trim($nationality));

        parent::populateState($ordering, $direction);
    }
}