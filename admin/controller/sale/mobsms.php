<?php
class ControllerSaleMobSMS extends Controller {
	private $error = array();
	 
	public function index() {
		$this->load->language('sale/mobsms');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/customer');
		
		$this->load->model('sale/customer_group');
		
		$this->load->model('sale/affiliate');
		
		$this->load->model('sale/mobsms');
				
		$config_data = array(
				'mobsms_admin_contact',
				'mobsms_message_type',
				'mobsms_username',
				'mobsms_password'
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				$data[$conf] = $this->config->get($conf);
			}
		}
		
		//$json = array();
		
		//if ($this->request->server['REQUEST_METHOD'] == 'POST') {
		//	if (!$this->request->post['message']) {
		//		$json['error']['message'] = $this->language->get('error_message');
		//	}
		//}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/store');
		
			/*$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
			
			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}
			*/
			$emails = array();
						
			switch ($this->request->post['to']) {
				case 'customer_all':
					$customer_data = array();
								
					$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
									
					$results = $this->model_sale_customer->getCustomers($customer_data);
		
					foreach ($results as $result) {
						$emails[] = $result['telephone'];
					}						
					break;
				case 'customer_group':
					$customer_data = array(
						'filter_customer_group_id' => $this->request->post['customer_group_id']
					);
					
					$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
									
					$results = $this->model_sale_customer->getCustomers($customer_data);
			
					foreach ($results as $result) {
						$emails[$result['customer_id']] = $result['telephone'];
					}						
					break;
				case 'customer':
					if (isset($this->request->post['customer'])) {					
						foreach ($this->request->post['customer'] as $customer_id) {
							$customer_info = $this->model_sale_customer->getCustomer($customer_id);
							
							if ($customer_info) {
								$emails[] = $customer_info['telephone'];
							}
						}
					}
					break;												
			}
			
			$emails = array_unique($emails);
			
			if ($emails) {
				
				$count = 0;
				foreach ($emails as $sms) {
					$mobsms = new mobsms();
					
					$mobsms->setMob($data['mobsms_username'], $data['mobsms_password']);
					$result = $mobsms->send($data['mobsms_admin_contact'], $sms, $this->request->post['mobsms_message_type'], html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8'), $this->db);
					$count++;
				}
			}
			
			if(!empty($result) && $result[0] < 0){
				$this->error['warning'] = $result[1];
			}
			else{
				$this->session->data['success'] = $this->language->get('text_success');
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		
		$data['tab_mobsms_general'] = $this->language->get('tab_mobsms_general');	
		$data['tab_mobsms_report'] = $this->language->get('tab_mobsms_report');
		
		$data['text_default'] = $this->language->get('text_default');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_customer_all'] = $this->language->get('text_customer_all');	
		$data['text_customer'] = $this->language->get('text_customer');	
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$data['text_affiliate'] = $this->language->get('text_affiliate');	
		$data['text_product'] = $this->language->get('text_product');	
		$data['text_mobsms_edit'] = $this->language->get('text_mobsms_edit');		
		$data['text_mobsms_balance'] = $this->language->get('text_mobsms_balance');	
		$data['text_no_results'] = $this->language->get('text_no_results');	

		$data['entry_mobsms_balance'] = $this->language->get('entry_mobsms_balance');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_to'] = $this->language->get('entry_to');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['help_customer'] = $this->language->get('help_customer');
		$data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_message_type'] = $this->language->get('entry_message_type');
		
		$data['button_send'] = $this->language->get('button_send');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_module_settings'] = $this->language->get('button_module_settings');
		
		if($data['mobsms_username'] == "" || $data['mobsms_password'] == ""){
			$data['mobsms_balance'] = sprintf($data['text_mobsms_balance'], $this->url->link('module/mobsms', 'token=' . $this->session->data['token'], 'SSL'));
		}
		else{
			$mobsms = new mobsms;
			$mobsms->setmobsms($data['mobsms_username'], $data['mobsms_password']);
			$data['mobsms_balance'] = $mobsms->getBalance();
		}
				
		$data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
	 	
		if (isset($this->error['message'])) {
			$data['error_message'] = $this->error['message'];
		} else {
			$data['error_message'] = '';
		}	

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/contact', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
				
		$data['action'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'], 'SSL');
		$data['module_settings'] = $this->url->link('module/mobsms', 'token=' . $this->session->data['token'], 'SSL');
		$data['text_mobsms_edit'] = sprintf($data['text_mobsms_edit'], $this->url->link('module/mobsms', 'token=' . $this->session->data['token'], 'SSL'));

		if (isset($this->request->post['store_id'])) {
			$data['store_id'] = $this->request->post['store_id'];
		} else {
			$data['store_id'] = '';
		}
		
		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['to'])) {
			$data['to'] = $this->request->post['to'];
		} else {
			$data['to'] = '';
		}
				
		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$data['customer_group_id'] = '';
		}
				
		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(0);
				
		$data['customers'] = array();
		
		if (isset($this->request->post['customer'])) {					
			foreach ($this->request->post['customer'] as $customer_id) {
				$customer_info = $this->model_sale_customer->getCustomer($customer_id);
					
				if ($customer_info) {
					$data['customers'][] = array(
						'customer_id' => $customer_info['customer_id'],
						'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname']
					);
				}
			}
		}

		$data['affiliates'] = array();
		
		if (isset($this->request->post['affiliate'])) {					
			foreach ($this->request->post['affiliate'] as $affiliate_id) {
				$affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);
					
				if ($affiliate_info) {
					$data['affiliates'][] = array(
						'affiliate_id' => $affiliate_info['affiliate_id'],
						'name'         => $affiliate_info['firstname'] . ' ' . $affiliate_info['lastname']
					);
				}
			}
		}
		
		$this->load->model('catalog/product');

		$data['products'] = array();
		
		if (isset($this->request->post['product'])) {					
			foreach ($this->request->post['product'] as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);
					
				if ($product_info) {
					$data['products'][] = array(
						'product_id' => $product_info['product_id'],
						'name'       => $product_info['name']
					);
				}
			}
		}
		//Start report
		if (isset($this->request->get['filter_id'])) {
			$filter_id = $this->request->get['filter_id'];
		} else {
			$filter_id = null;
		}
		
		if (isset($this->request->get['filter_source'])) {
			$filter_source = $this->request->get['filter_source'];
		} else {
			$filter_source = null;
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$filter_destination = $this->request->get['filter_destination'];
		} else {
			$filter_destination = null;
		}
		
		if (isset($this->request->get['filter_message'])) {
			$filter_message = $this->request->get['filter_message'];
		} else {
			$filter_message = null;
		}
		
		if (isset($this->request->get['filter_message_type'])) {
			$filter_message_type = $this->request->get['filter_message_type'];
		} else {
			$filter_message_type = null;
		}
		
		if (isset($this->request->get['filter_server_status'])) {
			$filter_server_status = $this->request->get['filter_server_status'];
		} else {
			$filter_server_status = null;
		}
		
		if (isset($this->request->get['filter_sent_on'])) {
			$filter_sent_on = $this->request->get['filter_sent_on'];
		} else {
			$filter_sent_on = date("Y-m-d");
		}
		
		if (isset($this->request->get['filter_tab'])) {
			$filter_tab = $this->request->get['filter_tab'];
		} else {
			$filter_tab = "button-general";
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'mobsms_report_id'; 
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		$data['button_filter'] = $this->language->get('button_filter');
		
		$data['filter_tab'] = $filter_tab;
		
		$data['text_ascii'] = $this->language->get('text_ascii');
		$data['text_unicode'] = $this->language->get('text_unicode');
		
		$data['column_id'] = $this->language->get('column_id');
		$data['column_source'] = $this->language->get('column_source');
		$data['column_destination'] = $this->language->get('column_destination');
		$data['column_message'] = $this->language->get('column_message');
		$data['column_message_type'] = $this->language->get('column_message_type');
		$data['column_server_status'] = $this->language->get('column_server_status');
		$data['column_sent_on'] = $this->language->get('column_sent_on');
		$data['column_action'] = $this->language->get('column_action');
		
		$data['mobsms_reports'] = array();
		
		$filter_data = array(
			'filter_id' 		=> $filter_id,
			'filter_source' 	=> $filter_source,
			'filter_destination' 	=> $filter_destination,
			'filter_message' 	=> $filter_message,
			'filter_message_type' 	=> $filter_message_type,
			'filter_server_status' 	=> $filter_server_status,
			'filter_start_date'	=> $filter_sent_on." 00:00:00", 
			'filter_end_date'	=> $filter_sent_on." 23:59:59",
			'sort'                  => $sort,
			'order'                 => $order
		);
		
		
		$results = $this->model_sale_mobsms->getmobsmsReports($filter_data);
		
		foreach ($results as $result) {
			$data['mobsms_reports'][] = array(
				'mobsms_report_id'	=> $result['mobsms_report_id'],
				'mobsms_source'		=> $result['mobsms_source'],
				'mobsms_destination'	=> $result['mobsms_destination'],
				'mobsms_message' 		=> $result['mobsms_message'],
				'mobsms_message_type' 	=> ($result['mobsms_message_type']==1 ? "ASCII" : "Unicode"),
				'mobsms_server_status'	=> $result['mobsms_server_status'],
				'mobsms_sent_on'		=> $result['mobsms_sent_on']
			);
		}
		
		$data['filter_id'] = $filter_id;
		$data['filter_source'] = $filter_source;
		$data['filter_destination'] = $filter_destination;
		$data['filter_message'] = $filter_message;
		$data['filter_message_type'] = $filter_message_type;
		$data['filter_server_status'] = $filter_server_status;
		$data['filter_sent_on'] = $filter_sent_on;
		
		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}
		
		if (isset($this->request->get['filter_source'])) {
			$url .= '&filter_source=' . $this->request->get['filter_source'];
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
			
		if (isset($this->request->get['filter_message'])) {
			$url .= '&filter_message=' . $this->request->get['filter_message'];
		}
		
		if (isset($this->request->get['filter_message_type'])) {
			$url .= '&filter_message_type=' . $this->request->get['filter_message_type'];
		}	
		
		if (isset($this->request->get['filter_server_status'])) {
			$url .= '&filter_server_status=' . $this->request->get['filter_server_status'];
		}
				
		if (isset($this->request->get['filter_sent_on'])) {
			$url .= '&filter_sent_on=' . $this->request->get['filter_sent_on'];
		}
		
		if (isset($this->request->get['filter_tab'])) {
			$url .= '&filter_tab=' . $this->request->get['filter_tab'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_id'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_report_id' . $url, 'SSL');
		$data['sort_source'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_source' . $url, 'SSL');
		$data['sort_destination'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_destination' . $url, 'SSL');
		$data['sort_message'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_message' . $url, 'SSL');
		$data['sort_message_type'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_message_type' . $url, 'SSL');
		$data['sort_server_status'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_server_status' . $url, 'SSL');
		$data['sort_sent_on'] = $this->url->link('sale/mobsms', 'token=' . $this->session->data['token'] . '&sort=mobsms_sent_on' . $url, 'SSL');
		
		$url = '';
		
		$data['sort'] = $sort;
		$data['order'] = $order;
		//End report
		if (isset($this->request->post['subject'])) {
			$data['subject'] = $this->request->post['subject'];
		} else {
			$data['subject'] = '';
		}
		
		if (isset($this->request->post['message'])) {
			$data['message'] = $this->request->post['message'];
		} else {
			$data['message'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mobsms.tpl', $data));
		//$this->response->setHeader('Content-Type: application/json');
		//$this->response->setOutput(json_decode($json));
	}
	
	private function validate() {
		$is_valid = true;
		if (!$this->user->hasPermission('modify', 'sale/mobsms')) {
			$error['warning'] = $this->language->get('error_permission');
			$is_valid = false;
		}
		
		if (!$this->request->post['message']) {
			$error['message'] = $this->language->get('error_message');
			$is_valid = false;
		}
				
				
		return $is_valid;		
	}
}
?>