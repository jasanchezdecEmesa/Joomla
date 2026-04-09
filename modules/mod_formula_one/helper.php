<?php

use Joomla\CMS\Factory;

class ModFormulaOneHelper
{
    /*
    * Get the list of Formula One teams.
    *
    * @param   array  $params An object containing the module parameters
    *
    * @access public
    */
    public static function getTeams($params)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__escuderias'));

        $db->setQuery($query);
        return $db->loadObjectList();
    }

    /*
    * Get the list of Formula One drivers.
    *
    * @param   array  $params An object containing the module parameters
    *
    * @access public
    */
    public static function getPilots($params)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__pilotos'));

        $db->setQuery($query);
        return $db->loadObjectList();
    }

    /*
    * Get the list of Formula One drivers by team.
    *
    * @param   int  $teamId The ID of the team
    *
    * @access public
    */
    public static function getPilotsByTeam($teamId)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__pilotos'))
            ->where($db->quoteName('id_escuderia') . ' = ' . $db->quote($teamId));

        $db->setQuery($query);
        return $db->loadObjectList();
    }
}