<?php
/*------------------------------------------------------------------------
# soutienpaimts.php - Faire un don Component
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
 * Soutienpaimts Model
 */
class SoutiensModelSoutienpaimts extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'alias', 'a.alias',
				'adip', 'a.adip',
				'referrers', 'a.referrers',
				'datesaisie', 'a.datesaisie',
				'raisonsoc', 'a.raisonsoc',
				'civilite', 'a.civilite',
				'name', 'a.name',
				'firstname', 'a.firstname',
				'email', 'a.email',
				'address', 'a.address',
				'cptaddress', 'a.cptaddress',
				'zipcode', 'a.zipcode',
				'city', 'a.city',
				'country', 'a.country',
				'phone', 'a.phone',
				'an_naiss', 'a.an_naiss',
				'dioc', 'a.dioc',
				'parois', 'a.parois',
				'message', 'a.message',
				'montant', 'a.montant',
				'paimode', 'a.paimode',
				'transacdonid', 'a.transacdonid',
				'numtransaction', 'a.numtransaction',
				'coderesponse', 'a.coderesponse',
				'txtresponse', 'a.txtresponse',
				'encaissement', 'a.encaissement',
				'commentpaimnt', 'a.commentpaimnt',
				'published', 'a.published',
				'ordering', 'a.ordering',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down',
			);
		}

		parent::__construct($config);
	}
	
	protected $basename;

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
				'a.id AS id, a.alias AS alias, a.adip AS adip,' .
				'a.referrers AS referrers, a.datesaisie AS datesaisie, a.raisonsoc AS raisonsoc,' .
				'a.civilite AS civilite, a.name AS name, a.firstname AS firstname,' .
				'a.email AS email, a.address AS address, a.cptaddress AS cptaddress, a.zipcode AS zipcode,' .
				'a.city AS city, a.country AS country, a.phone AS phone, a.an_naiss AS an_naiss, a.dioc AS dioc, a.parois AS parois, a.message AS message,' .
				'a.montant AS montant, a.paimode AS paimode, a.transacdonid AS transacdonid,' .
				'a.numtransaction AS numtransaction, a.coderesponse AS coderesponse, a.txtresponse AS txtresponse,' .
				'a.encaissement AS encaissement, a.commentpaimnt AS commentpaimnt,' .
				'a.published AS published,' .
				'a.ordering AS ordering,' .
				'a.checked_out AS checked_out, a.checked_out_time AS checked_out_time,' .
				'a.publish_up, a.publish_down'
			)
		);
		$query->from($db->quoteName('#__soutiens_soutienpaimt') . ' AS a');
		
		
				// Filter by begin date

		$begin = $this->getState('filter.begin');
		if (!empty($begin))
		{
			$query->where('a.datesaisie >= ' . $db->quote($begin));
		}

		// Filter by end date
		$end = $this->getState('filter.end');
		if (!empty($end))
		{
			$query->where('a.datesaisie <= ' . $db->quote($end));
		}

		
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
				$query->where('(a.name LIKE ' . $search . ' OR a.alias LIKE ' . $search . ')');
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
	public function getTable($type = 'Soutienpaimt', $prefix = 'SoutiensTable', $config = array())
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

		$begin = $this->getUserStateFromRequest($this->context . '.filter.begin', 'filter_begin', '', 'string');
		$this->setState('filter.begin', $begin);

		$end = $this->getUserStateFromRequest($this->context . '.filter.end', 'filter_end', '', 'string');
		$this->setState('filter.end', $end);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_soutiens');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.datesaisie', 'desc');
	}

	/**
	 * Get file name
	 *
	 * @return  string    The file name
	 * @since   1.6
	 */
	public function getBaseName()
	{
		if (!isset($this->basename))
		{

			$app = JFactory::getApplication();
			$basename = $this->getState('basename');
			$basename = str_replace('__SITE__', $app->getCfg('sitename'), $basename);


			$begin = $this->getState('filter.begin');
			if (!empty($begin))
			{
				$basename = str_replace('__BEGIN__', $begin, $basename);
			}
			else
			{
				$basename = str_replace('__BEGIN__', '', $basename);
			}

			$end = $this->getState('filter.end');
			if (!empty($end))
			{
				$basename = str_replace('__END__', $end, $basename);
			}
			else
			{
				$basename = str_replace('__END__', '', $basename);
			}

			$this->basename = $basename;
		}

		return $this->basename;
	}


	/**
	 * Get the file type.
	 *
	 * @return  string    The file type
	 * @since   1.6
	 */
	public function getFileType()
	{
		return $this->getState('compressed') ? 'zip' : 'csv';
	}

	/**
	 * Get the mime type.
	 *
	 * @return  string    The mime type.
	 * @since   1.6
	 */
	public function getMimeType()
	{
		return $this->getState('compressed') ? 'application/zip' : 'text/csv';
	}

	/**
	 * Get the content
	 *
	 * @return  string    The content.
	 * @since   1.6
	 */
	public function getContent()
	{
		if (!isset($this->content))
		{

			$this->content = '';
			$this->content .=
				'"' . str_replace('"', '""', JText::_('COM_SOUTIENS_HEADING_NAME')) . '","' .
					str_replace('"', '""', JText::_('COM_SOUTIENS_HEADING_CLIENT')) . '","' .
					str_replace('"', '""', JText::_('JCATEGORY')) . '","' .
					str_replace('"', '""', JText::_('COM_SOUTIENS_HEADING_TYPE')) . '","' .
					str_replace('"', '""', JText::_('COM_SOUTIENS_HEADING_TYPE')) . '","' .
					str_replace('"', '""', JText::_('COM_SOUTIENS_HEADING_COUNT')) . '","' .
					str_replace('"', '""', JText::_('JDATE')) . '"' . "\n";

			foreach ($this->getItems() as $item)
			{

				$this->content .=
					'"' . str_replace('"', '""', $item->name) . '","' .
						str_replace('"', '""', $item->firstname) . '","' .
						str_replace('"', '""', $item->email) . '","' .
						str_replace('"', '""', $item->address) . '","' .
						str_replace('"', '""', $item->cptaddress) . '","' .
						str_replace('"', '""', $item->zipcode) . '","' .
						//str_replace('"', '""', ($item->track_type == 1 ? JText::_('COM_BANNERS_IMPRESSION') : JText::_('COM_BANNERS_CLICK'))) . '","' .
						//str_replace('"', '""', $item->count) . '","' .
						str_replace('"', '""', $item->datesaisie) . '"' . "\n";
			}

			if ($this->getState('compressed'))
			{
				$app = JFactory::getApplication('administrator');

				$files = array();
				$files['track'] = array();
				$files['track']['name'] = $this->getBasename() . '.csv';
				$files['track']['data'] = $this->content;
				$files['track']['time'] = time();
				$ziproot = $app->getCfg('tmp_path') . '/' . uniqid('soutiens_soutienpaimts_') . '.zip';

				// run the packager
				jimport('joomla.filesystem.folder');
				jimport('joomla.filesystem.file');
				$delete = JFolder::files($app->getCfg('tmp_path') . '/', uniqid('banners_tracks_'), false, true);

				if (!empty($delete))
				{
					if (!JFile::delete($delete))
					{
						// JFile::delete throws an error
						$this->setError(JText::_('COM_SOUTIENS_ERR_ZIP_DELETE_FAILURE'));
						return false;
					}
				}

				if (!$packager = JArchive::getAdapter('zip'))
				{
					$this->setError(JText::_('COM_SOUTIENS_ERR_ZIP_ADAPTER_FAILURE'));
					return false;
				}
				elseif (!$packager->create($ziproot, $files))
				{
					$this->setError(JText::_('COM_SOUTIENS_ERR_ZIP_CREATE_FAILURE'));
					return false;
				}

				$this->content = file_get_contents($ziproot);
			}
		}

		return $this->content;
	}
}
?>