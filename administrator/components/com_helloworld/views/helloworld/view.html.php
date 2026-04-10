<?php

use Joomla\CMS\MVC\view\HtmlView;

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
 * HelloWorlds View
 *
 * @since  0.0.1
 */
class HelloWorldViewHelloWorld extends HtmlView
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination'); // <-- ESTO ES LO QUE FALTA
		$this->state         = $this->get('State');

		// Comprobar errores
		if (count($errors = $this->get('Errors'))) {
			throw new \Exception(implode("\n", $errors), 500);
		}

		parent::display($tpl);
	}
}