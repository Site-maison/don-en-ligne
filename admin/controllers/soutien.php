<?php
/*------------------------------------------------------------------------
# soutien.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Soutiens Controller Soutien
 */
class SoutiensControllerSoutien extends JControllerForm
{
	
	/**
	 * @var    string  The prefix to use with controller messages.
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_SOUTIENS_SOUTIEN';

/*
	public function __construct($config = array())
	{
		$this->view_list = 'soutiens'; // safeguard for setting the return view listing to the main view.
		parent::__construct($config);
	}
*/

	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param   array  $data  An array of input data.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	protected function allowAdd($data = array())
	{
		$user       = JFactory::getUser();
		
		return ($user->authorise('core.create', 'com_soutiens'));

	/*	$filter     = $this->input->getInt('filter_category_id');
		$categoryId = JArrayHelper::getValue($data, 'catid', $filter, 'int');
		$allow      = null;

		if ($categoryId)
		{
			// If the category has been passed in the URL check it.
			$allow	= $user->authorise('core.create', $this->option . '.category.' . $categoryId);
		}

		if ($allow === null)
		{
			// In the absence of better information, revert to the component permissions.
			return parent::allowAdd($data);
		}
		else
		{
			return $allow;
		}
	*/
	
	}

	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		
		$user = JFactory::getUser();
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;

		// Since there is no asset tracking and no categories, revert to the component permissions.
		return parent::allowEdit($data, $key);

// voir com_banners si on a des catégories
	}

	/**
	 * Method to run batch operations.
	 *
	 * @param   string  $model  The model
	 *
	 * @return  boolean  True on success.
	 *
	 * @since	2.5
	 */
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model	= $this->getModel('Soutien', '', array());

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_soutiens&view=soutiens' . $this->getRedirectToListAppend(), false));
// ou 		$this->setRedirect('index.php?option=com_soutiens&view=soutiens');

		return parent::batch($model);
	}

	/**
	 * Function that allows child controller access to model data
	 * after the data has been saved.
	 * 
	 * @param   JModel  &$model     The data model object.
	 * @param   array   $validData  The validated data.
	 * 
	 * @return  void
	 * 
	 * @since   11.1
	 */
	protected function postSaveHook(JModelLegacy &$model, $validData = array())
	{
		$model->save($data);

	}

}
?>