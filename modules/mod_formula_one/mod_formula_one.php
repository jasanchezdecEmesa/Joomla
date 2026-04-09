<?php
use Joomla\CMS\Helper\ModuleHelper;

// No direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$teams = ModFormulaOneHelper::getTeams($params);
$pilots = ModFormulaOneHelper::getPilots($params);
require ModuleHelper::getLayoutPath('mod_formula_one');