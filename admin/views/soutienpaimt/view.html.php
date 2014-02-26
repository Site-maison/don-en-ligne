<?php
/*------------------------------------------------------------------------
# view.html.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Soutienpaimt View
 */
class SoutiensViewSoutienpaimt extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	/**
	 * display method of Soutien view
	 * @return void
	 */
	public function display($tpl = null)
	{
		// get the Data
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		};


		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

	}


	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		$canDo = SoutiensHelper::getActions($this->item->id);

		JToolBarHelper::title($isNew ? JText::_('Soutienpaimt :: New') : JText::_('Soutienpaimt :: Edit'), 'soutienpaimt');
		
		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit'))
		{
			JToolBarHelper::apply('soutienpaimt.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('soutienpaimt.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('soutienpaimt.save2new', 'JTOOLBAR_SAVE_AND_NEW');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			//JToolBarHelper::custom('phocagalleryc.save2copy', 'copy.png', 'copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			JToolbarHelper::save2copy('soutienpaimt.save2copy');

		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('soutienpaimt.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('soutienpaimt.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
	//	JToolbarHelper::help('JHELP_COMPONENTS_TAGS_MANAGER_EDIT');
	}

}
?>