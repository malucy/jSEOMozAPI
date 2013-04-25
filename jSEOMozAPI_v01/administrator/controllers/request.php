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

jimport('joomla.application.component.controllerform');

/**
 * Request controller class.
 */
class SeomozapiControllerRequest extends JControllerForm
{

    function __construct() {
        $this->view_list = 'requests';
        parent::__construct();
    }

}