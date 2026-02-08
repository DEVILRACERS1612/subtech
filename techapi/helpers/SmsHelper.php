<?php
class SmsHelper {

    private $apiKey = "lxLciVl57kTPB2vS";
    private $senderId = "SUBTCH"; // Example sender ID

    public function send($mobile, $message) {
        $msg=urlencode($message);
        $url="https://www.bulksmsindia.app/V2/http-api.php?apikey=".$this->apiKey."&number=".$mobile."&message=".$msg."&senderid=".$this->senderId."&format=json";
		 $curl = curl_init();
		 curl_setopt_array($curl, array(
			 CURLOPT_URL => $url,
			 CURLOPT_RETURNTRANSFER => true,
		 ));
		 
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return ["status"=>false, "message"=>"SMS send failed: $err"];
        }else{
            return true;
        }
        
    }
}