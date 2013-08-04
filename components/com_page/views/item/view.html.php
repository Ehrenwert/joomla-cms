<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_page
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * HTML View class for the Page component
 *
 * @package     Joomla.Site
 * @subpackage  com_page
 */
class PageViewItem extends JViewLegacy
{
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();

		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		var_dump($this);

		parent::display($tpl);
	}
}
