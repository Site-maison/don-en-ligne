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

// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * Soutiens Model
 */
class SoutiensModelSoutiens extends JModelList
{
	
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'alias', 'a.alias',
				'emailfor', 'a.emailfor',
				'nommail', 'a.nommail',
				'emailcopy', 'a.emailcopy',
				'subjectmail', 'a.subjectmail',
				'introform', 'a.introform',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'published', 'a.published',
				'ordering', 'a.ordering',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down',
			);
		}

		parent::__construct($config);
	}


	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery() //$query->from('#__soutiens_soutien');
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.

		$query->select(
			$this->getState(
				'list.select',
				'a.id AS id, a.title AS title, a.alias AS alias,' .
					'a.emailfor AS emailfor,' .
					'a.nommail AS nommail, a.emailcopy AS emailcopy, a.subjectmail AS subjectmail,' .
					'a.introform AS introform,' .
					'a.checked_out AS checked_out, a.checked_out_time AS checked_out_time,' .
					'a.published AS published,' .
					'a.ordering AS ordering,' .
					'a.publish_up, a.publish_down'
			)
		);
		$query->from($db->quoteName('#__soutiens_soutien') . ' AS a');
		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$query->where('a.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.published IN (0, 1))');
		}
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . $db->escape($search, true) . '%');
				$query->where('(a.title LIKE ' . $search . ' OR a.alias LIKE ' . $search . ')');
			}
		}

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'ordering');
		$orderDirn = $this->state->get('list.direction', 'ASC');
	/*	if ($orderCol == 'ordering' || $orderCol == 'category_title')
		{
			$orderCol = 'c.title ' . $orderDirn . ', a.ordering';
		}
		if ($orderCol == 'client_name')
		{
			$orderCol = 'cl.name';
		}
	*/
		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;

	}
	
	
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id    A prefix for the store id.
	 * @return  string  A store id.
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   type      The table type to instantiate
	 * @param   string    A prefix for the table class name. Optional.
	 * @param   array     Configuration array for model. Optional.
	 * @return  JTable    A database object
	 * @since   1.6
	 */
	public function getTable($type = 'Soutien', $prefix = 'SoutiensTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_soutiens');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.title', 'desc');
	}

}
?>