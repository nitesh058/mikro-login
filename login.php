<?php
// Get the phone number from the form
$phoneNumber = $_POST['phoneNumber'];
// Generate a random 4-digit code
$code = rand(1000, 9999);

// Send SMS using SMS-GATEWAY
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.8:8080/message');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'sms:nvlab@12345');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "message": "Your WIFI OTP is $code", "phoneNumbers": ["$phoneNumber"] }');

$response = curl_exec($ch);

curl_close($ch);

// Save the code and phone number for validation later
file_put_contents('codes.txt', "$phoneNumber:$code\n", FILE_APPEND);

// Redirect the user to a page where they can enter the code
header("Location: enter_code.php?phoneNumber=$phoneNumber");
exit();
?>