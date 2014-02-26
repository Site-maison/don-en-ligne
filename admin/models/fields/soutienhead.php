<?php
	/*
	* GMapFP Component Google Map for Joomla! 3.0.x
	* Version J3/0
	* Creation date: Mars 2013
	* Author: Fabrice4821 - www.gmapfp.org
	* Author email: webmaster@gmapfp.org
	* License GNU/GPL
	*/

defined('_JEXEC') or die();

class JFormFieldSoutienHead extends JFormField
{

	public $type = 'SoutienHead';

	protected function getInput()
	{
		if ($this->element['default']) {
			return '<label style="background: #00B9B2; color: #FFFFFF; padding:5px; width: 100%"><strong>' . JText::_($this->element['default']) . '</strong></label>';
		} else {
			return '';
		}
	}

}

?>