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
 * soutiens View
 */
class SoutiensViewSoutiens extends JViewLegacy
{
	
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Soutiens view display method
	 * @return void
	 */
	function display($tpl = null) 
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		// Include helper submenu
		SoutiensHelper::addSubmenu('soutiens');

		$this->addToolbar();
		//require_once JPATH_COMPONENT . '/models/fields/bannerclient.php';

		// Include the component HTML helpers.
		//JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		
		require_once JPATH_COMPONENT . '/helpers/soutiens.php';

		$canDo = SoutiensHelper::getActions();
		$user = JFactory::getUser();
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		$state	= $this->get('State');

		JToolbarHelper::title(JText::_('COM_SOUTIENS_MANAGER_SOUTIENS'), 'soutiens');



/*
		if($canDo->get('core.create')){
			JToolBarHelper::addNew('soutien.add', 'JTOOLBAR_NEW');
		};
		if($canDo->get('core.edit')){
			JToolBarHelper::editList('soutien.edit', 'JTOOLBAR_EDIT');
		};
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			//JToolBarHelper::custom('soutiens.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			//JToolBarHelper::custom('soutiens.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::publish('soutiens.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('soutiens.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		JHtmlSidebar::setAction('index.php?option=com_soutiens&view=soutiens');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
		);
		
		
		if($canDo->get('core.delete')){
			JToolBarHelper::deleteList('COM_PHOCAGALLERY_WARNING_DELETE_ITEMS', 'soutiens.delete', 'JTOOLBAR_DELETE');
		};

*/
		if($canDo->get('core.admin')){
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_soutiens');
		};
	}
	
	protected function getSortFields() {
		return array(
			'a.ordering'	=> JText::_('JGRID_HEADING_ORDERING'),
			'a.title' 		=> JText::_('COM_SOUTIENS_TITLE'),
			'a.published' 	=> JText::_('COM_SOUTIENS_PUBLISHED'),
			'a.id' 			=> JText::_('JGRID_HEADING_ID')
		);
	}
}
?>