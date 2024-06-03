<!DOCTYPE html>
<?php
if(isset($_POST['login'])){
	// Authorisation details.
	$username = "bsharith07092005@gmail.com";
	$hash = "b2185ae24e291c2a05d83aa87ddd6d6a4ee87ab7cf011c333f0d1ae67fdfff01";
    
	// Config variables. Consult http://api.txtlocal.com/docs for more info.
	$test = "0";
    $name=$_POST['name'];


	// Data for text message. This is the text message data.
	$sender = "API Test"; // This is who the message appears to be from.
	$numbers = $_POST['num']; // A single number or a comma-seperated list of numbers
	$otp=mt_rand(100000,999999);
    setcookie("otp", $otp);
    $message = "hey ".$name." your otp is ";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('https://api.txtlocal.com/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	echo("otp send successfully");
    curl_close($ch);
}
if(isset($_POST['ver'])){
    $verotp=$_POST['otp'];
    if($verotp==$_COOKIE['otp']){
        echo("login success");
    }
    else{
        echo("otp wrong");
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="otp.php">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="num" placeholder="ph num">
        <input type="submit" name="login" value="sign(login)[send otp]">
        <input type="text" name="otp" placeholder="otp">
        <input type="submit" name="ver" value="verify otp" >
    </form>
</body>
</html>