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

// import Joomla table library
jimport('joomla.database.table');

/**
 * Soutienpaimts Table Soutienpaimt class
 */
class SoutiensTableSoutienpaimt extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__soutiens_soutienpaimt', 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  An optional array or space separated list of properties
	 * to ignore while binding.
	 *
	 * @return  mixed  Null if operation was satisfactory, otherwise returns an error string
	 *
	 * @see     JTable::bind
	 * @since   3.1
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 * @throws  UnexpectedValueException
	 */
	public function check()
	{
		// Check for valid name.
		if (trim($this->name) == '')
		{
			throw new UnexpectedValueException(sprintf('The name is empty'));
		}

		if (empty($this->alias))
		{
			$this->alias = $this->name;
		}
		$this->alias = JApplication::stringURLSafe($this->alias);
		if (trim(str_replace('-', '', $this->alias)) == '')
		{
			$this->alias = JFactory::getDate()->format("Y-m-d-H-i-s");
		}

		// Check the publish down date is not earlier than publish up.
		if ((int) $this->publish_down > 0 && $this->publish_down < $this->publish_up)
		{
			throw new UnexpectedValueException(sprintf('End publish date is before start publish date.'));
		}
			
	/* on insère un nouvel id de transaction suivant le datetime du moment */
	$app 	= JFactory::getApplication();
	$this->db = JFactory::getDBO(); 
	$transgen = mktime();
			// Set the new user group maps.
			$this->_db->setQuery(
				'INSERT INTO `#__sout_transac_num` (`id`, `dateheure`)' .
				//' VALUES ('.$this->id.', '.implode('), ('.$this->id.', ', $this->groups).')'
				' VALUES (NULL, '.$transgen.')'
			);
			$this->_db->query();
	$montime=$this->db->insertId();
		//$this->transacdonid = '6'.substr($montime, strlen($montime)-5, 5);
		$this->transacdonid = substr($montime, strlen($montime)-6, 6);

		return true;
	}

	/**
	 * Overriden JTable::store to set modified data and user id.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 */

	/**
	 * Method to delete a node and, optionally, its child nodes from the table.
	 *
	 * @param   integer  $pk        The primary key of the node to delete.
	 * @param   boolean  $children  True to delete child nodes, false to move them up a level.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 * @see     http://docs.joomla.org/JTableNested/delete
	 */

}
?>