<?php
class SMS{

    private $conn;
      
    public $clientid;
	public $apikey;
	public $senderid;
	public $message;
	public $mobile;
	public $error;
    public function __construct(){
        $this->clientid = '78ece01f-f33c-4cad-8b4b-4c25cd4c885c';
		$this->apikey='4bcc771d-3981-4e82-bc6f-67a4e82b8095';
		$this->senderid='MSCHOL';
		
		$this->error='';
    }
	public function send_sms()
	{
		$sms_text = urlencode($this->message);
		$api_url ="https://sms.shinenetcore.com/vendorsms/pushsms.aspx?clientid=".$this->clientid."&apikey=".$this->apikey."&msisdn=".$this->mobile."&sid=".$this->senderid."&msg=".$sms_text."&fl=0&gwid=2";
		
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $api_url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			$this->error="CURL Error #:" . $err;
		  return false;
		} else {
		  return true;
		}
	}
}
$objsms= new SMS();
?>