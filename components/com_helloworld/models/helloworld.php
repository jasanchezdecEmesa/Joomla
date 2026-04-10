<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Database\DatabaseInterface;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class HelloWorldModelHelloWorld extends ItemModel
{
	/**
	 * @var string message
	 */
	protected $message;

	/**
	 * Devuelve el item del modelo
	 *
	 * @param   int|null  $pk  Id del item
	 *
	 * @return  object
	 */
	public function getItem($pk = null)
	{
		$item = new stdClass();
		$item->message = $this->getMsg();

		return $item;
	}


    public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return Table::getInstance($type, $prefix, $config);
	}
	/**
	 * Get the message
         *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg($id = 1)
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}

		if (!isset($this->messages[$id]))
		{
			// Request the selected id
			$jinput = Factory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			// Get a TableHelloWorld instance
			$table = $this->getTable();

			// Load the message
			$table->load($id);

			// Assign the message
			$this->messages[$id] = $table->greeting;
		}

		return $this->messages[$id];
	}
}