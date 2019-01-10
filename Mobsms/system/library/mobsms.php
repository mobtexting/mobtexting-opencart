<?php

error_reporting(0);
final class MobSMS
{
    protected $Mob_username;
    protected $Mob_password;
    protected $Mob_sendsms_api = 'http://portal.mobtexting.com/api/v2/';
    protected $Mob_balance_api = 'http://portal.mobtexting.com/api/v2/';

    private function setUsername($Mob_username)
    {
        $this->Mob_username = $Mob_username;
    }

    private function setPassword($Mob_password)
    {
        $this->Mob_password = $Mob_password;
    }
    public function setApi($username, $password)
    {
        $this->Mob_username = $username;
        $this->Mob_password = $password;
    }

    public function setMob($Mob_username, $Mob_password)
    {
        $this->setUsername($Mob_username);
        $this->setPassword($Mob_password);
    }

    public function getMessage($accurate, $message)
    {
        $codes = [
            '{{order_id}}',
            '{{order_status}}',
            '{{customer}}',
            '{{invoice}}',
            '{{email}}',
            '{{total}}',
            '{{reward}}',
            '{{date_added}}',
            '{{date_modified}}',
            '{{billing_firstname}}',
            '{{billing_lastname}}',
            '{{billing_address_1}}',
            '{{billing_city}}',
            '{{billing_postcode}}',
            '{{billing_state}}',
            '{{billing_country}}',
            '{{shipping_firstname}}',
            '{{shipping_lastname}}',
            '{{shipping_address_1}}',
            '{{shipping_city}}',
            '{{shipping_postcode}}',
            '{{shipping_state}}',
            '{{shipping_country}}',
            '{{payment_method}}',
        ];
        $message = str_replace($codes, $accurate, $message);

        return $message;
    }

    public function getMessageForCheckout($accurate, $message)
    {
        //$codes   = ['{{order_id}}','{{firstname}}','{{email}}','{{total}}','{{currency_code}}','{{invoice_no}}'];
        $codes   = ['{{order_id}}','{{firstname}}','{{lastname}}','{{email}}','{{total}}','{{currency_code}}','{{invoice_no}}','{{shipping_company}}','{{shipping_address_1}}','{{shipping_address_2}}','{{shipping_city}}','{{shipping_postcode}}','{{shipping_zone}}','{{shipping_country}}','{{payment_method}}'];
        $message = str_replace($codes, $accurate, $message);

        return $message;
    }

    public function exportOrder($filename, $message)
    {
        $dirPath = DIR_SYSTEM.'var/export/';
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }
        file_put_contents(
            $dirPath.$filename.'.txt',
            $message
        );
    }

    private function MobcURL($link)
    {
        $http = curl_init($link);
        // do your curl thing here
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        $http_result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        curl_close($http);

        file_put_contents('../../log.txt', $link);

        return $http_result;
    }

    public function getBalance()
    {
        if (!$this->Mob_username || !$this->Mob_password) {
            exit('Please set your Mob senderid and apikey');
        }

        $Mob_balance_api = $this->Mob_balance_api;
        $Mob_username    = $this->Mob_username;
        $Mob_password    = $this->Mob_password;
        $link           = $Mob_balance_api.'account/balance';
        $link .= '?access_token='.urlencode($Mob_password);
        $res    = json_decode($this->MobcURL($link), true);
        
        foreach ($res['data'] as $key => $value) {
            if ($value['service'] == "T") {
                $credits = $value['credits'];
            }
            
        }
        $result = $res['data']['credits'] ?: $res['credits'];

        $balance = (float) $credits;

        return $credits;
    }

    public function getStatus($order_id)
    {
        $db          = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $order_query = $db->query('SELECT name FROM '.DB_PREFIX."order_status WHERE order_status_id = '".(int) $order_id."'");
        foreach ($order_query->rows as $product) {
            $status = $product['name'];
        }

        return $status;
    }

    public function send($originator, $destination, $messagetype, $message, $db)
    {
        $service = 'T';  //Transactional
        if (!$this->Mob_username || !$this->Mob_password) {
            exit('Please set your Mob senderid and apikey');
        }
        $Mob_send_api = $this->Mob_sendsms_api;
        $Mob_username = $this->Mob_username;
        $Mob_password = $this->Mob_password;
        $data        = $Mob_send_api.'sms/send';
        $data .= '?access_token='.urlencode($Mob_password);
        $data .= '&service='.$service;
        $data .= '&to='.urlencode($destination);
        $data .= '&sender='.urlencode($Mob_username);
        $data .= '&message='.urlencode($originator);
        $data .= '&message='.urlencode($message);

        $result = $this->MobcURL($data);

        return $result;
    }
}
