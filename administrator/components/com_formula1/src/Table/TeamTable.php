<?php

namespace Alumno\Component\Formula1\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class TeamTable extends Table
{
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__formula1_teams', 'id', $db);
    }
}