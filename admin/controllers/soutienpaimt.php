<?php
/*------------------------------------------------------------------------
# soutienpaimt.php - Faire un don Component
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
 * Soutienpaimts Controller Soutienpaimt
 */
class SoutiensControllerSoutienpaimt extends JControllerForm
{
	
	protected $text_prefix = 'COM_SOUTIENS_SOUTIENPAIMT';

/*
	public function __construct($config = array())
	{
		$this->view_list = 'soutienpaimts'; // safeguard for setting the return view listing to the main view.
		parent::__construct($config);
	}
*/
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
	 
/*
	protected function postSaveHook(JModelLegacy &$model, $validData = array())
	{
		$model->save($data);

	}
*/

}
?>