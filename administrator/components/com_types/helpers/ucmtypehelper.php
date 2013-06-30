<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_types
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * UCM Type helper.
 *
 * @package     Joomla.Administrator
 */
class UCMTypeHelper
{
	/**
	 * Return Content type Fields for given View.
	 *
	 * @param   string  $type_alias  Type alias.
	 * @param   string  $view  View name.
	 * @param   bool  $published_only  Return only active or not.
	 *
	 * @return  array Array with fields
	 */
	public static function getFields($type_alias, $view = 'form', $published_only = true)
	{
		return array();
	}

	/**
	 * Return Default Content type Fields.
	 *
	 * @param   string  $type_alias  Type alias.
	 *
	 * @return  array Array with fields
	 */
	public static function getFieldsDefault($type_alias)
	{
		// Cache!
		static $fields_cache;

		if (isset($fields_cache[$type_alias])) {
			return $fields_cache[$type_alias];
		}

		$app = JFactory::getApplication();

		// Find file name
		$alias_parts = explode('.', $type_alias);
		$source = empty($alias_parts[1]) ? $alias_parts[0] : $alias_parts[1];

		// Add include folders
		$path_administrator = JPATH_ADMINISTRATOR . '/components/' . $alias_parts[0];

		JForm::addFormPath($path_administrator . '/models/forms');
		//JForm::addFieldPath($path_administrator . '/models/fields');
		JForm::addFormPath($path_administrator . '/model/form');
		//JForm::addFieldPath($path_administrator . '/model/field');

		// Get a original form.
		try
		{
			//$form = JForm::getInstance($type_alias, $source, array(), true);
			//$fields = JForm::getInstance($type_alias, $source, array(), true, 'descendant-or-self::field');
			// Get fields out from groups
			// @TODO: hm ???
			// @TODO: need more safe way to get the main fields, eg: title, text;
			//		  and skip metadata, options, language etc.
			$fields = JForm::getInstance($type_alias, $source, array(), true,
					'field'
					. ' | descendant::fieldset[not(@name)]/field' // The user form have fieldset[@name]
					. ' | descendant::fields[not(@name)]/field'
					. ' | descendant::fields[not(@name)]/fieldset/field'
					);
			//$names = JForm::getInstance($type_alias, $source, array(), true, '//@name');

		}
		catch (Exception $e)
		{
			$app->enqueueMessage($e->getMessage(), 'error');
			return array();
		}

		// Fields elements
		$elements = $fields->getGroup(null);
		//return empty($elements) ? array() : array_values($elements);

		$fields_cache[$type_alias] = array();
		$i = 0;
		foreach ($elements as $element){
			$type = strtolower($element->type);

			// Skip Spacer
			if($type == 'spacer')
			{
				continue;
			}

			$field = new UCMFormField();

			$field->setup(array(
				'field_id' => null,
				'type' => $type,
				'name' => $element->name,
				'label' => $element->title,
				'default' => $element->default,
				'ordering' => $i,
				'state' => 1,
				'view' => 'form',
				'view_type' => 'input',
				'value' => $element->value,
				'element' => $element,
			));

			$fields_cache[$type_alias][] = $field;
			$i++;


		}
var_dump($fields_cache[$type_alias]);
		return $fields_cache[$type_alias];;
	}

}