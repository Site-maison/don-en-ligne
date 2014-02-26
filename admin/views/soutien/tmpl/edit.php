<?php
/*------------------------------------------------------------------------
# edit.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
$params = $this->form->getFieldsets('params');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'soutien.cancel' || document.formvalidator.isValid(document.id('soutien-form')))
		{
			Joomla.submitform(task, document.getElementById('soutien-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_soutiens&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="soutien-form" class="form-validate form-horizontal">
<!-- Begin Banner -->
<div class="span10 form-horizontal">

	<fieldset>
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_SOUTIENS_SOUTIEN_DETAILS', true)); ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('title'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('title'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('alias'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('alias'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('emailfor'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('emailfor'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('nommail'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('nommail'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('emailcopy'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('emailcopy'); ?>
					</div>
				</div>
                
				<div class="control-group" id="custom">
					<div class="control-label">
						<?php echo $this->form->getLabel('subjectmail'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('subjectmail'); ?>
					</div>
				</div>
				<div class="control-group" id="url">
					<div class="control-label">
						<?php echo $this->form->getLabel('introform'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('introform'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('id'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('id'); ?>
					</div>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>


			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_SOUTIENS_GROUP_LABEL_PUBLISHING_DETAILS', true)); ?>
				<?php foreach ($this->form->getFieldset('publish') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	</div>
	<!-- End Newsfeed -->
	<!-- Begin Sidebar -->
	<div class="span2">
		<h4><?php echo JText::_('JDETAILS');?></h4>
		<hr />
		<fieldset class="form-vertical">
				<div class="control-group">
					<div class="controls">
						<?php echo $this->form->getValue('title'); ?>
					</div>
				</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('published'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('published'); ?>
				</div>
			</div>
		</fieldset>
	</div>
	<!-- End Sidebar -->
</form>

