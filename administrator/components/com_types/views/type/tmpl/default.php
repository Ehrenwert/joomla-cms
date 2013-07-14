<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_types
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<form action="<?php echo JRoute::_('index.php?option=com_types&layout=edit&type_id=' . (int) $this->item->type_id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<!-- Base Type Info -->
			<div class="control-group">
				<?php echo $this->form->getLabel('type_id'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('type_id'); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo $this->form->getLabel('type_title'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('type_title'); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo $this->form->getLabel('type_alias'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('type_alias'); ?>
				</div>
			</div>

			<!-- Layouts tabs -->
			<ul class="nav nav-tabs">
			<?php foreach($this->item->layouts as $layout):?>
				<li<?php if($layout->layout_name == $this->item->layout_name) echo ' class="active"'?>>
				<?php
				$link = JRoute::_('index.php?option=com_types&view=type&layout=edit&type_id=' . $this->item->type_id . '&layout_name=' . $layout->layout_name);
				echo JHtml::link($link, $layout->layout_title);
				?>
				</li>
			<?php endforeach;?>
			</ul>

			<!-- Fields Configuration -->
			<?php echo JLayoutHelper::render('ucm.type.edit.fields', $this); ?>
			<?php //echo $this->loadTemplate('fields'); ?>

		</div>
	</div>

	<!-- Hidden -->
	<?php echo $this->form->getInput('item_view'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
