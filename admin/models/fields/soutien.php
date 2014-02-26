<?php
/*------------------------------------------------------------------------
# soutienszero.php - Faire un don Component
# ------------------------------------------------------------------------
# author    MiniHenk
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.minihenk.org
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * title Form Field class for the Soutiens component
 */
class JFormFieldSoutien extends JFormFieldList
{
	/**
	 * The title field type.
	 *
	 * @var		string
	 */
	protected $type = 'Soutien';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__soutiens_soutien.id as id, #__soutiens_soutien.title as title');
		$query->from('#__soutiens_soutien');
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
		$options = array();
		if($items){
			foreach($items as $item){
				$options[] = JHtml::_('select.option', $item->id, ucwords($item->title));
			};
		};
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
?>