<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$app = Factory::getApplication();
$input = $app->getInput();

$teamId = $input->getInt('team_id', 0);

$teams = ModFormulaOneHelper::getTeams($params);
$selectedTeam = null;
$pilots = [];

if ($teamId > 0) {
    $selectedTeam = ModFormulaOneHelper::getTeamById($teamId);
    $pilots = ModFormulaOneHelper::getPilotsByTeam($teamId);
}

require ModuleHelper::getLayoutPath('mod_formula_one', $params->get('layout', 'default'));

