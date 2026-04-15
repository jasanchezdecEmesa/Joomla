<?php

namespace Alumno\Component\Formula1\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class DriversModel extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select([
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
            . ' ON ' . $db->quoteName('d.team_id') . ' = ' . $db->quoteName('t.id')
        );

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where($db->quoteName('d.id') . ' = ' . (int) substr($search, 3));
            } else {
                $search = $db->quote('%' . $db->escape($search, true) . '%');
                $query->where('(' . $db->quoteName('d.first_name') . ' LIKE ' . $search . 
                            ' OR ' . $db->quoteName('d.last_name') . ' LIKE ' . $search . ')');
            }
        }

        $nationality = $this->getState('filter.nationality');

        if (!empty($nationality)) {
            $nationality = trim($nationality);
            $query->where($db->quoteName('d.nationality') . ' = ' . $db->quote($nationality));
        }

        $query->order($db->quoteName('d.last_name') . ' ASC');

        return $query;
    }

    public function getNationalities()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('DISTINCT ' . $db->quoteName('nationality', 'value'))
            ->select($db->quoteName('nationality', 'text'))
            ->from($db->quoteName('#__formula1_drivers'))
            ->where($db->quoteName('nationality') . ' != ' . $db->quote(''))
            ->order($db->quoteName('nationality') . ' ASC');

        $db->setQuery($query);
        $results = $db->loadObjectList();

        return $results;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        $app = \Joomla\CMS\Factory::getApplication();

        $filters = $app->input->get('filter', [], 'array');

        $search = isset($filters['search']) ? $filters['search'] : '';
        $this->setState('filter.search', trim($search));

        $nationality = isset($filters['nationality']) ? $filters['nationality'] : '';
        
        $app->setUserState($this->context . '.filter.nationality', $nationality);
        $this->setState('filter.nationality', $nationality);

        parent::populateState($ordering, $direction);
    }
}