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
		if (task == 'soutienpaimt.cancel' || document.formvalidator.isValid(document.id('soutienpaimt-form')))
		{
			Joomla.submitform(task, document.getElementById('soutienpaimt-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_soutiens&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="soutienpaimt-form" class="form-validate form-horizontal">
<!-- Begin Banner -->
<div class="span10 form-horizontal">

	<fieldset>
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_SOUTIENS_SOUTIEN_DETAILS', true)); ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('name'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('name'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('firstname'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('firstname'); ?>
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
						<?php echo $this->form->getLabel('datesaisie'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('datesaisie'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('raisonsoc'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('raisonsoc'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('civilite'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('civilite'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('email'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('email'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('address'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('address'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('cptaddress'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('cptaddress'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('zipcode'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('zipcode'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('city'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('city'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('country'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('country'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('phone'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('phone'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('an_naiss'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('an_naiss'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('dioc'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('dioc'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('parois'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('parois'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('message'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('message'); ?>
					</div>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>


			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'soutientransac', JText::_('COM_SOUTIENS_INFOTRANSAC', true)); ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('montant'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('montant'); ?>
					</div>
				</div>
                
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('paimode'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('paimode'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('transacdonid'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('transacdonid'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('numtransaction'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('numtransaction'); ?>
					</div>
				</div>
                
				<div class="control-group" id="custom">
					<div class="control-label">
						<?php echo $this->form->getLabel('coderesponse'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('coderesponse'); ?>
					</div>
				</div>
				<div class="control-group" id="url">
					<div class="control-label">
						<?php echo $this->form->getLabel('txtresponse'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('txtresponse'); ?>
					</div>
				</div>
				<div class="control-group" id="url">
					<div class="control-label">
						<?php echo $this->form->getLabel('encaissement'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('encaissement'); ?>
					</div>
				</div>
				
			<?php echo JHtml::_('bootstrap.endTab'); ?>


			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'soutiendetails', JText::_('COM_SOUTIENS_SOUTIEN_INFOSSUP', true)); ?>
        	    <div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('id'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('id'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('commentpaimnt'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('commentpaimnt'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('adip'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('adip'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('referrers'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('referrers'); ?>
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
						<?php echo $this->form->getValue('firstname').' '.$this->form->getValue('name'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<?php echo '<strong>'.$this->form->getValue('montant').' euros </strong>' ; ?>
					</div>
				</div>
                <div class="control-group">
					<div class="controls">
						<?php echo JText::_('COM_SOUTIENS_SOUTIENPAIMTS_PAIMODE').' : ';
						if ($this->form->getValue('paimode')=='1') echo 'Carte Bancaire';
						if ($this->form->getValue('paimode')=='2') echo 'Chèque';
						if ($this->form->getValue('paimode')=='3') echo 'Prélèvement automatique mensuel';
						if ($this->form->getValue('paimode')=='4') echo 'Prélèvement automatique trimestriel';
						 ?>
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

