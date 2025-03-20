<?php
$phoneNumber = $_POST['phoneNumber'];  // Get the phone number from the form
$enteredCode = $_POST['code'];         // Get the code entered by the user

// Read the saved codes from the file
$codes = file('codes.txt', FILE_IGNORE_NEW_LINES);

// Find the correct code for the phone number
foreach ($codes as $line) {
    list($savedPhoneNumber, $savedCode) = explode(':', $line);
    if ($savedPhoneNumber == $phoneNumber && $savedCode == $enteredCode) {
        $API = new RouterosAPI();
        
        // Replace with your MikroTik Router's IP and credentials
        $host = '192.168.1.7';  // MikroTik IP address
        $username = 'admin';      // MikroTik username
        $password = '123456';   // MikroTik password

        if ($API->connect($host, $username, $password)) {
            // Add user to Hotspot Active List
            $API->write('/ip/hotspot/active/add', false);
            $API->write('=address=' . $_SERVER['REMOTE_ADDR']);  // Use user's IP address
            $API->write('=mac-address=' . $_POST['macAddress']);  // Use user's MAC address
            $API->write('=user=' . $phoneNumber);  // Use the phone number as the username
            $API->read();  // Execute the command

            // Optionally, you can send a success message or redirect the user
            echo "Code verified! You are now connected to the hotspot.";

            // Disconnect from the MikroTik API
            $API->disconnect();
        } else {
            echo "Unable to connect to MikroTik API.";
        }
        break;
    }
}

echo "Invalid code. Please try again.";
?>