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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_seomozapi', JPATH_ADMINISTRATOR);
// Add the css files to the head of the document
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/3V.css');
//$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/template.css');
$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/base.css');
$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/layout.css');
$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/custom.css');
$document->addStyleSheet(JURI::base() . 'components/com_seomozapi/assets/css/boostability.fonts.css.css');
$document->addStyleSheet('http://fonts.googleapis.com/css?family=Open+Sans:400,700,600');

?>

<!-- Styling for making front end forms look OK -->
<!-- This should probably be moved to the template CSS file -->
<style>
    .front-end-edit ul {
        padding: 0 !important;
    }
    .front-end-edit li {
        list-style: none;
        margin-bottom: 6px !important;
    }
    .front-end-edit label {
        margin-right: 10px;
        display: block;
        float: left;
        width: 200px !important;
    }
    .front-end-edit .radio label {
        float: none;
    }
    .front-end-edit .readonly {
        border: none !important;
        color: #666;
    }    
    .front-end-edit #editor-xtd-buttons {
        height: 50px;
        width: 600px;
        float: left;
    }
    .front-end-edit .toggle-editor {
        height: 50px;
        width: 120px;
        float: right;
    }

    #jform_rules-lbl{
        display:none;
    }

    #access-rules a:hover{
        background:#f5f5f5 url('../images/slider_minus.png') right  top no-repeat;
        color: #444;
    }

    fieldset.radio label{
        width: 50px !important;
    }
</style>
<script type="text/javascript">
    function getScript(url, success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
                done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                    || this.readyState == 'loaded'
                    || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function() {
        js = jQuery.noConflict();
        js(document).ready(function() {
            js('#form-request').submit(function(event) {

            });


        });
    });

</script>

<div class="request-edit front-end-edit">
    <div id="inner_t_heading">
        <div class="wrapper">
            <div class="inner_heading_box">
                <h2>Free Website Analysis</h2>
                <h3>Find Out How Your Site Is Doing</h3>
            </div>
        </div>
    </div>
    <div id="main_body_container" class="no_bg">
        <div class="wrapper" style="width: 1000px;">
            <div id="body_container">
                <div id="left_container" style="border: 0px; width: 1000px; padding-top: 0px;">
                    <div id="content_container_inner">

                        <div style="margin-top: 10px;">
                            <h2 style="margin-bottom: 15px; font-size: 24px;">
                                Your Instant Website Analysis helps you know:</h2>
                            <div id="info1" style="float: left;">
                                <div style="float: left; width: 40px; height: 40px; margin-top: 2px; background: url('./images/icon1.png') no-repeat scroll 0 0px transparent;
                                     margin-right: 5px;">
                                </div>
                                <div style="float: left; margin-left: 10px; line-height: 45px;">
                                    <div style="float: left; font-size: 18px; color: #888;">
                                        If your <strong>site</strong> is optimized for</div>
                                    <img src="./images/search_engine_logos.png" style="float: left; margin-top: 7px;"
                                         alt="" />
                                </div>
                                <div style="clear: both;">
                                </div>
                                <div style="margin-top: 15px;">
                                    <div style="float: left; width: 40px; height: 40px; margin-top: 2px; background: url('./images/icon2.png') no-repeat scroll 0 0px transparent;
                                         margin-right: 5px;">
                                    </div>
                                    <div style="float: left; margin-left: 10px; line-height: 45px; font-size: 18px; color: #888;">
                                        How you <strong>compare</strong> to your online competition</div>
                                </div>
                                <div style="clear: both;">
                                </div>
                                <div style="margin-top: 10px;">
                                    <div style="float: left; width: 40px; height: 40px; margin-top: 2px; background: url('./images/icon3.png') no-repeat scroll 0 0px transparent;
                                         margin-right: 5px;">
                                    </div>
                                    <div style="float: left; margin-left: 10px; line-height: 45px; font-size: 18px; color: #888;">
                                        Important metrics used to <strong>identify</strong> prominent problems with your
                                        site</div>
                                </div>
                                <div style="clear: both;">
                                </div>
                                <div style="margin: 15px 0 0 50px !important;float: left;">
                                    <div id="screenshots">
                                        <a href="./images/software-preview-large.jpg">
                                            <img src="./images/software-preview-small.png" alt="" /></a>
                                    </div>
                                    <div style="font-size: 14px;margin-left: 5px;">
                                        Click to Preview</div>
                                </div>
                            </div>
                            <div id="info2"></div>
                            <div id="formContainer" class="form-container" style="margin-top: 0px; padding-bottom: 0px;
                                 float: right; width: 323px; margin-top: -20px;">
                                <div id="bgForm" style="position: relative;">
                                </div>
                                <div style="background-color: #CECECE; width: 296px; float: right; margin-top: -30px;
                                     margin-right: 2px;">
                                    <div id="seoform">

                                        <form id="form-request" action="<?php echo JRoute::_('index.php?option=com_seomozapi&task=request.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
                                                <!--this is where the old seomoz form is merged into joomla                                           <ul style="margin:0px;">
                                                <li style="display:none;"><?php echo $this->form->getLabel('id'); ?>
                                                    <?php echo $this->form->getInput('id'); ?></li>
                                                <?php $canState = false; ?>
                                                <?php $canState = $canState = JFactory::getUser()->authorise('core.edit.state', 'com_seomozapi'); ?>				<?php if (!$canState): ?>
                                                    <li style="display:none;"><?php echo $this->form->getLabel('state'); ?>
                                                        <?php
                                                        $state_string = 'Unpublish';
                                                        $state_value = 0;
                                                        if ($this->item->state == 1):
                                                            $state_string = 'Publish';
                                                            $state_value = 1;
                                                        endif;
                                                        echo $state_string;
                                                        ?></li>
                                                    <input type="hidden" name="jform[state]" value="<?php echo $state_value; ?>" />				<?php else: ?>					<li><?php echo $this->form->getLabel('state'); ?>
                                                        <?php echo $this->form->getInput('state'); ?></li>
                                                <?php endif; ?>				<li style="display:none;"><?php echo $this->form->getLabel('created_by'); ?>
                                                    <?php echo $this->form->getInput('created_by'); ?></li>
                                                <li ><?php echo $this->form->getLabel('customer_name'); ?>
                                                    <?php echo $this->form->getInput('customer_name'); ?></li>
                                                <li><?php echo $this->form->getLabel('email'); ?>
                                                    <?php echo $this->form->getInput('email'); ?></li>
                                                <li><?php echo $this->form->getLabel('phone_number'); ?>
                                                    <?php echo $this->form->getInput('phone_number'); ?></li>
                                                <li><?php echo $this->form->getLabel('domain'); ?>
                                                    <?php echo $this->form->getInput('domain'); ?></li>
                                                <li><?php echo $this->form->getLabel('domain_competitor'); ?>
                                                    <?php echo $this->form->getInput('domain_competitor'); ?></li>
                                                <li>                                                <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
                                                <?php echo JText::_('or'); ?>
                                                <a href="<?php echo JRoute::_('index.php?option=com_seomozapi&task=request.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

                                                <input type="hidden" name="option" value="com_seomozapi" />
                                                <input type="hidden" name="task" value="requestform.save" />
                                                <?php echo JHtml::_('form.token'); ?></li>-->
                                                
                                                <!--this is where the old seomoz form is merged into joomla-->
                  
                                                <label>
                                                    Name</label>
                                                <input type="text" id="name" name="name" required placeholder="Your name"/><br />
                                                <label>
                                                    Email</label>
                                                <input type="email" id="email" name="email" required placeholder="A valid email address"/><br />
                                                <label>
                                                    Phone</label>
                                                <input type="text" id="phone" name="phone" placeholder="Your phone # - Optional"/><br />
                                                <label>
                                                    Website</label>
                                                <input type="url" id="domain" name="domain" required placeholder="Your domain"/><br />
                                                <label>
                                                    Competitor Website</label>
                                                <input type="url" id="domain_competitor" name="domain_competitor" placeholder="Competitor domain" /><br />
                                                <input type="submit" id="generateSubmit" value="" style="margin-top: -3px; border: 0px; width: 215px; height: 61px;" />
                                                
                                                
                                                
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div style="clear: both;">
                </div>
            </div>
        </div>
    </div>
</div>
    
