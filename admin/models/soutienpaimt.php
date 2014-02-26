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

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Soutienpaimt Model
 */
class SoutiensModelSoutienpaimt extends JModelAdmin
{

	protected $text_prefix = 'COM_SOUTIENS_SOUTIEN';

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since   3.1
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			$user = JFactory::getUser();
                return $user->authorise( "core.delete", "com_soutiens.soutiens." . $record->id );
				
		/*	if ($record->published != -2)
			{
				return;
			}
			$user = JFactory::getUser();

			return parent::canDelete($record);
			*/
		}
	}

	/**
	 * Method to test whether a record can have its state changed.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 *
	 * @since   3.1
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		return parent::canEditState($record);
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   3.1
	*/
	public function getTable($type = 'Soutienpaimt', $prefix = 'SoutiensTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the row form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 *
	 * @since   3.1
	 */
	public function getForm($data = array(), $loadData = true)
	{
	//	$extension = $this->getState('soutien');
		$jinput = JFactory::getApplication()->input;

		// Get the form.
		$form = $this->loadForm('com_soutiens.soutienpaimt', 'soutienpaimt', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		$user = JFactory::getUser();
		if (!$user->authorise('core.edit.state', 'com_soutiens' . $jinput->get('id')))
		{
			// Disable fields for display.
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('published', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('published', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app  = JFactory::getApplication();
		$data = $app->getUserState('com_soutiens.edit.soutienpaimt.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData('com_soutiens.soutienpaimt', $data);

		return $data;
	}


	/**
	 * @since  3.0
	 */
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->name		= htmlspecialchars_decode($table->name, ENT_QUOTES);
		$table->alias		= JApplication::stringURLSafe($table->alias);

		if (empty($table->alias))
		{
			$table->alias = JApplication::stringURLSafe($table->name);
		}

		if (empty($table->id))
		{
			// Set the values

			// Set ordering to the last item if not set
			if (empty($table->ordering))
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__soutiens_soutienpaimt');
				$max = $db->loadResult();

				$table->ordering = $max + 1;
			}
		}
		else
		{
			// Set the values
			//$table->modified	= $date->toSql();
			//$table->modified_by	= $user->get('id');
		}
		// Increment the content version number.
		//$table->version++;
	}


	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since	3.1
	 */
	public function save($data)
	{
		$app = JFactory::getApplication();

		// Alter the title for save as copy
		if ($app->input->get('task') == 'save2copy')
		{
			list($name, $alias) = $this->generateNewTitle($data['alias'], $data['name']);
			$data['name']	= $name;
			$data['alias']	= $alias;
		}
		$return = parent::save($data);

		return $return;
	}

	/**
	 * Method to change the title & alias.
	 *
	 * @param   integer  $category_id  The id of the parent.
	 * @param   string   $alias        The alias.
	 * @param   string   $name         The title.
	 *
	 * @return  array  Contains the modified title and alias.
	 *
	 * @since   3.1
	 */
	protected function generateNewTitle($alias, $name)
	{
		// Alter the title & alias !! title = name pour ce composant
		$table = $this->getTable();

		while ($table->load(array('alias' => $alias)))
		{
			if ($name == $table->name) // pas sur du name ??
			{
				$name = JString::increment($name);
			}
			$alias = JString::increment($alias, 'dash');
		}

		return array($name, $alias);
	}




}
?>