<?php
include 'phpqrcode/qrlib.php';

$link_to_encode = $_GET['data'] ?? "https://www.subtech.in"; // Get data from URL parameter, default if not set

//$file_path = BASE_PATH.'qrcodes/'.$row['serial_no'].'.png.';
//QRcode::png($link_to_encode, $file_path, 'H', 8, 4);

// Set headers to output a PNG image
header('Content-type: image/png');


// Output the QR code directly to the browser

QRcode::png($link_to_encode, false, 'L', 2, 0);
exit; // Stop further execution
?>