<?php
/**
 * @version     0.0.11
 * @package     com_seomozapi
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      michael lucy <michael.lucy@3vbizsolutions.com> - http://3vbizsolutions.com
 */

// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_seomozapi', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_seomozapi');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_seomozapi')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if( $this->item ) : ?>

    <div class="item_fields">
        
        <ul class="fields_list">

			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_CUSTOMER_NAME'); ?>:
			<?php echo $this->item->customer_name; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_EMAIL'); ?>:
			<?php echo $this->item->email; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_PHONE_NUMBER'); ?>:
			<?php echo $this->item->phone_number; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_DOMAIN'); ?>:
			<?php echo $this->item->domain; ?></li>
			<li><?php echo JText::_('COM_SEOMOZAPI_FORM_LBL_REQUEST_DOMAIN_COMPETITOR'); ?>:
			<?php echo $this->item->domain_competitor; ?></li>


        </ul>
        
    </div>
    <?php if($canEdit): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_seomozapi&task=request.edit&id='.$this->item->id); ?>">Edit</a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_seomozapi')):
								?>
									<a href="javascript:document.getElementById('form-request-delete-<?php echo $this->item->id ?>').submit()">Delete</a>
									<form id="form-request-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_seomozapi&task=request.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
										<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="jform[customer_name]" value="<?php echo $this->item->customer_name; ?>" />
										<input type="hidden" name="jform[email]" value="<?php echo $this->item->email; ?>" />
										<input type="hidden" name="jform[phone_number]" value="<?php echo $this->item->phone_number; ?>" />
										<input type="hidden" name="jform[domain]" value="<?php echo $this->item->domain; ?>" />
										<input type="hidden" name="jform[domain_competitor]" value="<?php echo $this->item->domain_competitor; ?>" />
										<input type="hidden" name="option" value="com_seomozapi" />
										<input type="hidden" name="task" value="request.remove" />
										<?php echo JHtml::_('form.token'); ?>
									</form>
								<?php
								endif;
							?>
<?php else: ?>
    Could not load the item
<?php endif; ?>
