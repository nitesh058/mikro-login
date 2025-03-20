<?php
$phoneNumber = $_GET['phoneNumber']; // Retrieve phone number from the URL
?>

<html>
<head>
    <title>Verify Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
            text-align: center;
        }
        input {
            padding: 10px;
            margin: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Enter the verification code sent to your phone</h1>
    <form action="validate_code.php" method="POST">
        <input type="hidden" name="phoneNumber" value="<?php echo $phoneNumber; ?>" />
        <input type="text" name="code" placeholder="Enter Code" required><br>
        <input type="submit" value="Verify Code">
    </form>
</body>
</html>
