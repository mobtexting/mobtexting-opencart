<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com   	   #
################################################################################################

/*
 * This file contains the english version of any static text required by your module in the admin area.
 * If you want to translate your module to another language, the idea is that you can just replace the
 * right hand column below with the changed language, rather than modifying every file in your module.
 * 
 * We will call these language strings through in the controller to make them available in the view. 
 * 
 * For your module, think about any text that you want to display and add it in here. Also replace all the
 * "MobSMS" text for the name of your module.
 * 
 */

// Example field added (see related part in admin/controller/module/mobsms.php)
$_['mobsms_example'] = 'Example Extra Text';



// Heading Goes here:
$_['heading_title']    = 'MobSMS';


// Text
$_['text_module']     = 'Modules';
$_['text_success']     = 'Success: You have modified module MobSMS!';
$_['text_mobsms_balance']   = 'Please set your username and password';
$_['text_start_mobsms']   = 'Click <a href="%s">here</a> to start sending SMS with MobSMS.';
$_['text_contact_example']   = 'Country Code + Phone Number (e.g. 60123456789 for Malaysia)';
$_['text_admin_alert_register']   = 'Alert admin when customer registers an account';
$_['text_admin_alert_checkout']   = 'Alert admin when customer checkouts';

$_['text_mobsms_new_customer_registered']   = 'A new customer, %s registered at your shopping cart.';
$_['text_mobsms_customer_checkout']   = 'New order rcvd frm customer %s. Order ID: %s';
$_['text_mobsms_customer_checkout_successful']   = 'Hi, you have successfully placed an order. Order ID: %s';

// Entry
$_['entry_mobsms_balance']   = 'MobSMS Balance:';
$_['entry_mobsms_username']    = 'MobSMS Username:'; // this will be pulled through to the controller, then made available to be displayed in the view.
$_['entry_mobsms_password']    = 'MobSMS Password:';
$_['entry_mobsms_admin_contact']    = 'Admin Contact:';
$_['entry_mobsms_message_type']    = 'Message Type:';
$_['entry_mobsms_admin_alert']    = 'Admin Alert:';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify module MobSMS!';
?>