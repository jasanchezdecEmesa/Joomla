<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;

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
	/**
	 * Get the message
         *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg()
	{
		if (!isset($this->message))
		{
			$this->message = 'Hello World!';
		}

		return $this->message;
	}
}