<?php
/**
 * @version     0.0.11
 * @package     com_seomozapi
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      michael lucy <michael.lucy@3vbizsolutions.com> - http://3vbizsolutions.com
 */


// No direct access
defined('_JEXEC') or die;

class SeomozapiController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/seomozapi.php';

		$view		= JFactory::getApplication()->input->getCmd('view', 'requests');
        JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}
