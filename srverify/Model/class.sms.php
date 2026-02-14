<?php
class SMS{

    private $conn;
	private $api_table_name = "mi_sms_api_setting";
	private $sms_limit_table = "mi_sms_recharge";
	private $sms_debit_table = "mi_sms_sent_report";
	  
    public $clientid;
	public $apikey;
	public $senderid;
	public $message;
	public $docfile;
	public $mobile;
	public $name;
	public $admno;
    public $fee;
	public $page_code;
	public $till;
	public $active;
	public $templateid;
	public $tot_dr_sms;
	public $tot_cr_sms;
	public $tot_bal_sms;
	
	public $token_id;
	public $instance_id;
	
	
	public $error;
    public function __construct($db){
        $this->conn = $db;
    }
	
	public function send_sms()
	{
		$msg=urlencode($this->message);
		$mob=$this->mobile;
		$url="https://www.bulksmsindia.app/V2/http-api.php?apikey=lxLciVl57kTPB2vS&number=".$mob."&message=".$msg."&senderid=SUBTCH&format=json";
		/// return $url;
		 $curl = curl_init();
		 curl_setopt_array($curl, array(
			 CURLOPT_URL => $url,
			 CURLOPT_RETURNTRANSFER => true,
		 ));
		 //return $url;
		 $response = curl_exec($curl);
		/// return $response;
		 $err = curl_error($curl);
		 curl_close($curl);
		 if ($err) {
			 $this->error= "cURL Error #:" . $err;
			 return false;
		 } else {
			return true;
		 }
	
	}
	
}
$objsms= new SMS($db);
?>