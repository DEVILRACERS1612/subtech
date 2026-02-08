<?php
$url = "https://subtech.in/techapi/v1/verify-otp";
$data = [
    "mobile"=> "9899816353",
    "otp"=>"1753"
];
/*$data = [
    "api_key"=> "Zx9kY3tN28qL1VmAa4JrT5wXf6BdMpQ",
    "method"=> "deleteRequest",
	"request"=> [
	"reqno"=> "LG2601280001"
	]
];
$data = [
    "api_key"=> "Zx9kY3tN28qL1VmAa4JrT5wXf6BdMpQ",
    "method"=> "updateRequest",
	"request"=> [
	"reqno"=> "LG2601280001",
    "category"=> "Trolly",
    "location"=> "Building A",
    "destination"=> "Kasna",
	"product"      => "xxx",
	"process_type" => "xxxxx",
	"estimation_minutes" => "60",  
	"remarks" => "xxx",
	"lg_request_date" => "", 
	"attribute1" => "",
	"attribute2" => "",
	"attribute3" => "",
	"attribute4" => "",
	"attribute5" => ""
	]
];*/

$payload = json_encode($data);

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => [
        "Content-Type: application/json",
        "Accept: application/json",
        "Content-Length: " . strlen($payload)
    ],
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => true,   // agar SSL issue aaye to false
    CURLOPT_SSL_VERIFYHOST => 2
]);

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode([
        "status" => "error",
        "curl_error" => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo json_encode([
    "http_code" => $httpCode,
    "response"  => json_decode($response, true)
], JSON_PRETTY_PRINT);