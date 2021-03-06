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

require_once JPATH_COMPONENT.'/controller.php';
include JPATH_COMPONENT.'/jSON/seo_controller.php';

/**
 * Request controller class.
 */
class SeomozapiControllerRequestForm extends SeomozapiController
{

	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @since	1.6
	 */
    
        
	public function edit()
	{
		$app			= JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.
		$previousId = (int) $app->getUserState('com_seomozapi.edit.request.id');
		$editId	= JFactory::getApplication()->input->getInt('id', null, 'array');

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_seomozapi.edit.request.id', $editId);

		// Get the model.
		$model = $this->getModel('RequestForm', 'SeomozapiModel');

		// Check out the item
		if ($editId) {
            $model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId) {
            $model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_seomozapi&view=request&layout=edit', false));
	}

	/**
	 * Method to save a user's profile data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function save()
	{
		// Check for request forgeries.
		//JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('RequestForm', 'SeomozapiModel');
		
                // Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
                $custname = $data['customer_name'];
                $email = $data['email'];
                $URL1 = $data['domain'];
                $URL2 = $data['domain_competitor'];
                
		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_seomozapi.edit.request.data', JRequest::getVar('jform'),array());

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_seomozapi.edit.request.id');
			$this->setRedirect(JRoute::_('index.php?option=com_seomozapi&view=request&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_seomozapi.edit.request.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_seomozapi.edit.request.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_seomozapi&view=request&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_seomozapi.edit.request.id', null);

        $mozVar1 = new mozAPI();
        $htmlbody = $mozVar1->getHTMLBody();
        $html = $htmlbody;
        $html=$html.'Welcome '.$custname.', below is your analysis:<br/><br/>';
        $mozArray1 = $mozVar1->getMozData($URL1);
        $mozArray2 = $mozVar1->getMozData($URL2);
        $mozVar1->getResultsHeader($URL1, $URL2);
        $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"uid","External Links");
        $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"ueid","Juice Passing External Links");
        $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"umrp","mozRank");
        $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"upa","Page Authority");
        $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"pda","Domain Authority");
        $mozVar1->getResultsFooter();
        $html = $html.$mozVar1->html;
        die($html);
        // Redirect to the list screen.
        //$this->setMessage(JText::_('Item saved successfully'));
        //$menu = & JSite::getMenu();
        //$item = $menu->getActive();
        //$this->setMessage(JText::_('Thank You - Item Save Successfully'));
        //$this->setRedirect($this->baseurl.'/2013/components/com_seomozapi/jSON/seo_controller.php', false);
        //$this->setRedirect(JRoute::_($item->link, false));

		// Flush the data from the session.
		//$app->setUserState('com_seomozapi.edit.request.data', null);
	}
    
    
    function cancel() {
		$menu = & JSite::getMenu();
        $item = $menu->getActive();
        $this->setRedirect(JRoute::_($item->link, false));
    }
    
	public function remove()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model = $this->getModel('RequestForm', 'SeomozapiModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_seomozapi.edit.request.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_seomozapi.edit.request.id');
			$this->setRedirect(JRoute::_('index.php?option=com_seomozapi&view=request&layout=edit&id='.$id, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->delete($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_seomozapi.edit.request.data', $data);

			// Redirect back to the edit screen.
			$id = (int)$app->getUserState('com_seomozapi.edit.request.id');
			$this->setMessage(JText::sprintf('Delete failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_seomozapi&view=request&layout=edit&id='.$id, false));
			return false;
		}

            
        // Check in the profile.
        if ($return) {
            $model->checkin($return);
        }
        
        // Clear the profile id from the session.
        $app->setUserState('com_seomozapi.edit.request.id', null);

        // Redirect to the list screen.
        $this->setMessage(JText::_('Item deleted successfully'));
        $menu = & JSite::getMenu();
        $item = $menu->getActive();
        $this->setRedirect(JRoute::_($item->link, false));

		// Flush the data from the session.
		$app->setUserState('com_seomozapi.edit.request.data', null);
	}
    
    
}