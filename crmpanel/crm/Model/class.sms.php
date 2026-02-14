<?php
class SMS{

    //private $conn;
      
    public $clientid;
	public $apikey;
	public $senderid;
	public $message;
	public $mobile;
	public $error;
    public function __construct(){
        $this->clientid = '78ece01f-f33c-4cad-8b4b-4c25cd4c885c';
		$this->apikey='4bcc771d-3981-4e82-bc6f-67a4e82b8095';
		$this->senderid='MISCOL';
		
		$this->error='';
    }
	public function send_sms()
	{
		$msg=urlencode($this->message);
		$mob=$this->mobile;
		$url="https://www.bulksmsindia.app/V2/http-api.php?apikey=lxLciVl57kTPB2vS&number=".$mob."&message=".$msg."&senderid=SUBTCH&format=json";
		 //return $url;
		 $curl = curl_init();
		 curl_setopt_array($curl, array(
			 CURLOPT_URL => $url,
			 CURLOPT_RETURNTRANSFER => true,
		 ));
		 //return $url;
		 $response = curl_exec($curl);
		 //return $response;
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
//$url="https://www.bulksmsindia.app/V2/http-api.php?apikey=lxLciVl57kTPB2vS&number=9899816353&message=We have registered your complaint ID: 1234 on 04-08-2025 for Product1. Thank you for reaching out to Subtech Support&senderid=SUBTCH&format=json";
$objsms= new SMS();
?>