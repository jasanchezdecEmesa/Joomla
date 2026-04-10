<?php

use Joomla\CMS\Table\Table;
use Joomla\CMS\Database\DatabaseInterface;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class HelloWorldTableHelloWorld extends Table
{
	/**
	 * Constructor
	 *
	 * @param   DatabaseInterface  &$db  A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__helloworld', 'id', $db);
	}
}