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
 * "mobsms" text for the name of your module.
 * 
 */

// Example field added (see related part in admin/controller/module/mobsms.php)
$_['mobsms_example']                              = 'Example Extra Text';



// Heading Goes here:
$_['heading_title']                             = 'MobSMS';


// Text
$_['text_module']                               = 'Modules';
$_['text_success']                              = 'Success: You have modified module mobsms!';
$_['text_mobsms_balance']                         = 'Please set your username and password';
$_['text_start_mobsms']                           = 'Click <a href="%s">here</a> to start sending SMS with mobsms.';
$_['text_contact_example']                      = 'Country Code + Phone Number (e.g. 60123456789 for Malaysia)';
$_['text_contact_multiple_example']             = 'Separate contacts with a comma (e.g. 60123456789,60987654321)';
$_['text_admin_alert_register']                 = 'Alert admin when customer registers an account';
$_['text_admin_alert_checkout']                 = 'Alert admin when customer checkouts';
$_['text_customer_alert_checkout']              = 'Alert customer when customer successfully checkouts';
$_['text_customer_alert_order_status']          = 'Alert customer when order status is updated';
$_['text_admin_alert_additional_settings']      = 'Additional Alert Settings: ';
$_['text_admin_alert_include_items']            = 'Include ordered items in SMS';
$_['text_admin_alert_allow_long_message']       = 'Allow long message if message length exceeds 159 characters for ASCII or 69 for Unicode';
$_['text_mobsms_message_customer_checkout']       = 'Hi, you have successfully placed an order. Order ID: %s';
$_['text_mobsms_message_customer_checkout_required']  = '"%s": Order ID. (required)';
$_['text_mobsms_message_customer_order_status']   = 'Hi, your order, order ID: %s has just been updated to status: %s';
$_['text_mobsms_message_customer_order_status_required']  = '"%s" 1: Order ID, "%s" 2: Order Status. (required)';

// Button
$_['button_send_sms']   = 'Send SMS';

// Entry
$_['entry_mobsms_balance']                        = 'mobsms Balance';
$_['entry_mobsms_username']                       = 'mobsms Username'; // this will be pulled through to the controller, then made available to be displayed in the view.
$_['entry_mobsms_password']                       = 'mobsms Password';
$_['entry_mobsms_admin_contact']                  = 'Admin Contact';
$_['entry_mobsms_alert_contacts']                 = 'Alert Contacts';
$_['entry_mobsms_message_type']                   = 'Message Type';
$_['entry_mobsms_admin_alert']                    = 'Admin Alert';
$_['entry_mobsms_customer_alert']                 = 'Customer Alert';
$_['entry_mobsms_message_customer_checkout']      = 'Customer Checkout Message';
$_['entry_mobsms_message_customer_order_status']  = 'Customer Order Status Message';
$_['order_enabled'] = 'Send SMS';
$_['order_sender'] = 'Sender ID (Max 11 Characters)';
$_['order_status_sender'] = 'Sender ID (Max 11 Characters)';
$_['order_message'] = 'Message (Max 160 Characters)';
$_['order_link_your_account'] = 'Link your account';
$_['notify_admin'] = 'Notify admin';
$_['admin_telephone'] = 'Admin telephone';
// Error
$_['error_permission']                          = 'Warning: You do not have permission to modify module mobsms!';


$_['heading_title']    = 'mobsms SMS';
$_['text_module']     = 'Modules';
$_['text_success']     = 'Success: You have modified mobsmsSMS API!';
$_['text_mobsms_balance']   = 'Enter Senderid and Apikey';
$_['text_start_mobsms']   = 'Click <a href="%s">here</a> to start sending SMS with mobsms.';
$_['text_contact_example']   = 'Country Code + Phone Number (e.g. 60123456789 for Malaymobsmsa)';
$_['text_admin_alert_customer_register']   = 'Alert admin when customer registers an account';
$_['text_admin_alert_customer_checkout']   = 'Alert admin when customer checkouts';
$_['text_admin_alert_order_status'] = 'Alert admin when order status changes';
$_['text_customer_alert_ckeckout']   = 'Alert customer when customer successfully checkouts';
$_['text_customer_alert_order_status']   = 'Alert customer when order status is updated';
$_['text_admin_alert_additional_settings']   = 'Additional Alert Settings: ';
$_['text_admin_alert_include_items']    = 'Include ordered items in SMS';
$_['text_admin_alert_allow_long_message']    = 'Allow long message if message length exceeds 159 characters for ASCII or 69 for Unicode';
$_['button_send_sms']   = 'Send SMS';
$_['entry_mobsms_balance']   = 'Available Credits:';
$_['entry_mobsms_username']    = 'SenderId:';
$_['entry_mobsms_password']    = 'API Key:';
$_['entry_mobsms_admin_contact']    = 'Admin Contact:';
$_['entry_mobsms_message_type']    = 'Message Type:';
$_['entry_mobsms_admin_alert']    = 'Admin Alert:';
$_['entry_mobsms_customer_alert']    = 'Customer Alert:';
$_['order_enabled'] = 'Send SMS';
$_['order_sender'] = 'Sender ID (Max 11 Characters)';
$_['order_status_sender'] = 'Sender ID (Max 11 Characters)';
$_['order_message'] = 'Message (Max 160 Characters)';
$_['order_link_your_account'] = 'Link your account';
$_['notify_admin'] = 'Notify admin';
$_['admin_telephone'] = 'Admin telephone';
$_['error_permismobsmson'] = 'Warning: You do not have permismobsmson to modify module mobsms!';

?>