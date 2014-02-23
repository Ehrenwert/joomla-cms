<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_items
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * The Items Controller Helper
 *
 * @package     Joomla.Administrator
 * @subpackage  com_items
 */

class ItemsControllerHelper
{
	/**
	 * Method to parse a controller from a url
	 * Defaults to the base controllers and passes an array of options.
	 * $options[0] is the location of the controller which defaults to the core libraries (referenced as 'j'
	 * and then the named folder within the component entry point file.
	 * $options[1] is the name of the controller file,
	 * $options[2] is the name of the folder found in the component controller folder for controllers
	 * not prefixed with Types.
	 * Additional options maybe added to parameterise the controller.
	 *
	 * @param   JApplicationBase  $app  An application object
	 *
	 * @return  JController  A JController object
	 * @throws  LogicException when no controller found
	 *
	 */
	public function parseController($app)
	{
		$tasks = array();
		$location = '';
		$activity = '';
		$view = '';

		if ($task = $app->input->get('task'))
		{
			$tasks = explode('.', $task);
		}
		else
		{
			//@TODO: load from the menu item parameters
		}

		if (!empty($tasks[0]))
		{
			$location = strtolower($tasks[0]);
		}

		if (!empty($tasks[1]))
		{
			$activity = strtolower($tasks[1]);
		}


		if (!empty($tasks[2]))
		{
			$view = strtolower($tasks[2]);
		}

		$controllerName = ucfirst($location) . 'Controller' . ucfirst($view) . ucfirst($activity);

		if (!class_exists($controllerName))
		{
			throw new LogicException('Controller "' . $controllerName . '" not exists.', 404);
		}

		$controller			 = new $controllerName;
		$controller->options = $tasks;

		return $controller;
	}
}
