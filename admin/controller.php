<?php
/*------------------------------------------------------------------------
# controller.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die;

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller of Soutiens component
 */
class SoutiensController extends JControllerLegacy
{
	/**
	 * display task
	 *
	 * @return void
	 */
	
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/soutiens.php';
		//SoutiensHelper::updateReset();

		$view   = $this->input->get('view', 'soutiens');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'soutien' && $layout == 'edit' && !$this->checkEditId('com_soutiens.edit.soutien', $id)) {

			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_soutiens&view=soutiens', false));

			return false;
		}

		parent::display();

		return $this;
	}
}
?>