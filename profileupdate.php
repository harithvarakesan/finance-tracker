<?php
include 'connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

if(!isset($_SESSION["username"])){
    header("location: login.html");
    exit;
}

$username = htmlspecialchars($_SESSION["username"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $name =$_POST["name"];
    $mobile_no = $_POST["mobile_no"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    
$sql = "UPDATE `users` SET `name`=?, `emailid`=?, `mobile_no.`=?, `city`=?, `state`=? WHERE username=?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssssss", $name, $email, $mobile_no, $city, $state, $username);

$stmt->execute();
        header("location: profile.php");

    $conn->close();
}
?>

