<?php
/*------------------------------------------------------------------------
# soutiens.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Soutiens component helper.
 */
class SoutiensHelper
{
	/**
	 *	Configure the Linkbar.
	 */
	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(JText::_('Configuration'), 'index.php?option=com_soutiens&view=soutiens', $submenu == 'soutiens');
		JHtmlSidebar::addEntry(JText::_('Donateurs'), 'index.php?option=com_soutiens&view=soutienpaimts', $submenu == 'soutienpaimts');
		
	}

	/**
	 *	Get the actions
	 */
	public static function getActions($Id = 0)
	{
		jimport('joomla.access.access');

		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($Id)){
			$assetName = 'com_soutiens';
		} else {
		//	$assetName = 'com_soutiens.message.'.(int) $Id;
			$assetName = 'com_soutiens.soutiens.'.(int) $Id;
		};

		$actions = JAccess::getActions('com_soutiens', 'component');

		foreach ($actions as $action){
			$result->set($action->name, $user->authorise($action->name, $assetName));
		};

		return $result;
	}
}
?>