<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com    	   #
################################################################################################
class ModelModuleMobSMS extends Model {
	
	/*
	 * Most modules do not require their own database access. If you do want to store some new data that doesn't fit into the existing
	 * database tables, you could create them here like the example function below.
	 * 
	 * This file is basically just included for completeness of the DIY module. There are some uses for it, but these are more advanced and
	 * by the time you get to those I doubt you'll be needing my help :)
	 */
	
	// This function is how my blog module creates it's tables to store blog entries. You would call this function in your controller in a
	// function called install(). The install() function is called automatically by OC versions 1.4.9.x, and maybe 1.4.8.x when a module is
	// installed in admin.
	public function createMobSMSTables() {
		$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "mobsms` (
                `si_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `d` varchar(255) NOT NULL DEFAULT '',
                `fromorder_i` varchar(255) NOT NULL DEFAULT '',
                `to` varchar(255) NOT NULL DEFAULT '',
                `sms_message` text NOT NULL,
                `status` varchar(255) NOT NULL DEFAULT '',
                `status_message` varchar(255) NOT NULL DEFAULT '',
                `created_time` datetime DEFAULT NULL,
                PRIMARY KEY (`si_id`)
             )";
		$query = $this->db->query($sql);
	}	
	
	public function deleteMobSMSTables() {
		$query = $this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "mobsms");
	}

	public function get_order_statuses() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE language_id = 1");
        return $query->rows;
    }
}
?>