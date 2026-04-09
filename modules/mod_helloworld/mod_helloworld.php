<?php
use Joomla\CMS\Helper\ModuleHelper;

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$language = $params->get('lang', '1');
$hello = modHelloWorldHelper::getHello($language);
require ModuleHelper::getLayoutPath('mod_helloworld');