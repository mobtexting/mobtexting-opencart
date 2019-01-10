<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com  		   #
################################################################################################
class ControllerModuleMobSMS extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		//Load the language file for this module
		$this->load->language('module/mobsms');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mobsms', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		//This is how the language gets pulled through from the language file.
		//
		// If you want to use any extra language items - ie extra text on your admin page for any reason,
		// then just add an extra line to the $text_strings array with the name you want to call the extra text,
		// then add the same named item to the $_[] array in the language file.
		//
		// 'mobsms_example' is added here as an example of how to add - see admin/language/english/module/mobsms.php for the
		// other required part.
		
		$text_strings = array(
				// 'heading_title',
				// 'entry_si_balance',
				// 'text_contact_example',
				// 'text_start_mobsms',
				// 'text_send_sms',
				// 'text_admin_alert_register',
				// 'text_admin_alert_checkout',
				// 'text_customer_alert_checkout',
				// 'text_customer_alert_order_status',
				// 'text_admin_alert_additional_settings',
				// 'text_admin_alert_include_items',
				// 'text_admin_alert_allow_long_message',
				'text_mobsms_message_customer_checkout',
				// 'text_mobsms_message_customer_checkout_required',
				'text_mobsms_message_customer_order_status',
				// 'text_mobsms_message_customer_order_status_required',
				// 'button_save',
				// 'button_cancel',
				// 'button_send_sms',
				// 'entry_mobsms_balance',
				// 'entry_mobsms_admin_contact',
				// 'entry_mobsms_alert_contacts',
				// 'entry_mobsms_message_type',
				// 'entry_mobsms_username',
				// 'entry_mobsms_admin_alert',
				// 'entry_mobsms_customer_alert',
				// 'entry_mobsms_password',
				// 'entry_mobsms_message_customer_checkout',
				// 'order_enabled',
	   //          'order_sender',
	   //          'order_status_sender',
	   //          'order_message',
	   //          'order_link_your_account',
	   //          'notify_admin',
				'entry_mobsms_message_customer_order_status',//this is an example extra field added

			'heading_title',
            'text_mobsms_balance',
            'text_contact_example',
            'text_start_mobsms',
            'text_send_sms',
            'text_admin_alert_customer_register',
            'text_admin_alert_customer_checkout',
            'text_customer_alert_ckeckout',
            'text_customer_alert_order_status',
            'text_admin_alert_additional_settings',
            'text_admin_alert_include_items',
            'text_admin_alert_allow_long_message',
            'text_admin_alert_order_status',
            'button_save',
            'button_cancel',
            'button_send_sms',
            'entry_mobsms_balance',
            'entry_mobsms_admin_contact',
            'entry_mobsms_message_type',
            'entry_mobsms_username',
            'entry_mobsms_admin_alert',
            'entry_mobsms_customer_alert',
            'entry_mobsms_password',
            'order_enabled',
            'order_sender',
            'order_status_sender',
            'order_message',
            'order_link_your_account',
            'notify_admin',
            'admin_telephone',
		);
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		//END LANGUAGE
		
		//The following code pulls in the required data from either config files or user
		//submitted data (when the user presses save in admin). Add any extra config data
		// you want to store.
		//
		// NOTE: These must have the same names as the form data in your mobsms.tpl file
		//
		$config_data = array(
				// 'mobsms_admin_contact',
				// 'mobsms_alert_contacts',
				// 'mobsms_message_type',
				// 'mobsms_username',
				// 'mobsms_admin_alert_register',
				// 'mobsms_admin_alert_checkout',
				// 'mobsms_admin_alert_include_items',
				// 'mobsms_admin_alert_allow_long_message',
				// 'mobsms_customer_alert_checkout',
				// 'mobsms_customer_alert_order_status',
				// 'mobsms_password',
				'mobsms_message_customer_checkout',
				// 'order_sender_number',
	   //          'order_status_sender_number',
	   //          'order_message_value',
	   //          'order_enabled_value',
	   //          'notify_admin_value',
	   //          'admin_telephone_value',
	   //          'message_of_order_status',
	   //          'order_status_enabled',
	   //          'admin_alert_order_status',
				'mobsms_message_customer_order_status',//this becomes available in our view by the foreach loop just below.

			'mobsms_admin_contact',
            'mobsms_message_type',
            'mobsms_username',
            'mobsms_admin_alert_customer_register',
            'mobsms_admin_alert_customer_checkout',
            'mobsms_admin_alert_include_items',
            'mobsms_admin_alert_allow_long_message',
            'mobsms_customer_alert_ckeckout',
            'mobsms_customer_alert_order_status',
            'mobsms_password',
            'order_sender_number',
            'order_status_sender_number',
            'mobsms_order_message_value',
            'mobsms_order_enabled_value',
            'mobsms_notify_admin_value',
            'mobsms_notify_admin',
            'mobsms_admin_telephone_value',
            'message_of_order_status',
            'mobsms_order_status_enabled',
            'mobsms_admin_alert_order_status',
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				$data[$conf] = $this->config->get($conf);
			}
		}
		
		if($data['mobsms_username'] == "" || $data['mobsms_password'] == ""){
			$data['mobsms_balance'] = $data['text_mobsms_balance'];
		}
		else{
			$mobsms = new mobsms;
			$mobsms->setMob($data['mobsms_username'], $data['mobsms_password']);
			$data['mobsms_balance'] = $mobsms->getBalance();
		}
		
		if($data['mobsms_message_type'] == ""){
			$data['mobsms_message_type'] = 1;
		}
		
		if ($data['mobsms_message_customer_checkout'] == "") {
			$data['mobsms_message_customer_checkout'] = $data['text_mobsms_message_customer_checkout'];
		}
		
		if ($data['mobsms_message_customer_order_status'] == "") {
			$data['mobsms_message_customer_order_status'] = $data['text_mobsms_message_customer_order_status'];
		}
		
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		//SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS UNLESS YOU CHANGE YOUR MODULE NAME.
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/mobsms', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/mobsms', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['text_start_mobsms'] = sprintf($data['text_start_mobsms'], $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'], 'SSL'));
		$data['send_sms'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'], 'SSL');
	
		//This code handles the situation where you have multiple instances of this module, for different layouts.
		$data['modules'] = array();
		
		if (isset($this->request->post['mobsms_module'])) {
			$data['modules'] = $this->request->post['mobsms_module'];
		} elseif ($this->config->get('mobsms_module')) { 
			$data['modules'] = $this->config->get('mobsms_module');
		}

		$order_status = $this->get_order_status();
        $statusList = array();

        foreach ($order_status as $status) {
        	$status = 'mobsms_'.$status;
            if (isset($this->request->post[$status])) {
                $statusList[$status] = $this->request->post[$conf];
            } else {
                $statusList[$status] = $this->config->get($status);
            }
        }

        $data['status_list'] = $statusList;	

		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		//Choose which template file will be used to display this request.
		$this->template = 'module/mobsms.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['heading_title'] = $this->language->get('heading_title');

		//Send the output.
		$this->response->setOutput($this->load->view('module/mobsms.tpl', $data));
	}
	
	public function install() {
		
		$this->load->model('module/mobsms');
		
		$this->model_module_mobsms->createMobSMSTables();
	}
	
	public function uninstall() {
		
		$this->load->model('module/mobsms');
		
		$this->model_module_mobsms->deleteMobSMSTables();
	}
	/*
	 * 
	 * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
	 * You can add checks in here of your own.
	 * 
	 */
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/mobsms')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	public function get_order_status() {
        $this->load->model('module/mobsms');
        $os = $this->model_module_mobsms->get_order_statuses();

        $os1 = array();
        foreach($os as $key => $value) {
            $os1[] = str_replace(" ", "_", $value['name']).'_message_of_order_status';
        }
        return $os1;
    }


}
?>