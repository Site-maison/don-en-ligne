<?php
/*------------------------------------------------------------------------
# soutiensone.php - Faire un don Component
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
 * alias Form Field class for the Soutiens component
 */
class JFormFieldSoutienpaimt extends JFormFieldList
{
	/**
	 * The alias field type.
	 *
	 * @var		string
	 */
	protected $type = 'Soutienpaimt';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__soutiens_soutienpaimt.id as id, #__soutiens_soutienpaimt.alias as alias');
		$query->from('#__soutiens_soutienpaimt');
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
		$options = array();
		if($items){
			foreach($items as $item){
				$options[] = JHtml::_('select.option', $item->id, ucwords($item->alias));
			};
		};
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
?>