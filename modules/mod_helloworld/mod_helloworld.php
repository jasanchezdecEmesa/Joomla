<?php
use Joomla\CMS\Helper\ModuleHelper;

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$hello = modHelloWorldHelper::getHello($params);
require ModuleHelper::getLayoutPath('mod_helloworld');