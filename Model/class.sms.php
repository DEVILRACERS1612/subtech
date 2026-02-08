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
	public $mobile;
	public $docfile;
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
		$this->apikey='UjhXYlJtQTJxbDR2Q2g2b3BBWnJ5NkZvT0d1dERZUTl1XzZCYVZjVnVCMDo=';
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
	public function send_whatsapp_sms($mobile,$message){
		$url = 'https://api.interakt.ai/v1/public/message/';

		// API key को Base64 में एन्कोड करें
		$auth = ($this->apikey . ':');

		$headers = array(
			'Authorization: Basic ' . $auth,
			'Content-Type: application/json'
		);

		$data = array(
			"fullPhoneNumber" => $mobile,
			"type" => "Text",
			"data" => array(
				"message" => $message
			)
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		if (curl_error($ch)) {
			return "cURL Error: " . curl_error($ch);
		}

		curl_close($ch);

		return $response;
	}
}
$objsms= new SMS($db);
?>