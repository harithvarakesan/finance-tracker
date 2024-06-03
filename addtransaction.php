<?php
session_start(); 
include 'connection.php';

$username = htmlspecialchars($_SESSION["username"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction = $_POST["transaction"];
    $date = $_POST["date"];
    $type = $_POST["type"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    $sql = "INSERT INTO $username (`transaction`, `date`, `type`, `description`, `amount`) VALUES ('$transaction','$date','$type','$description','$amount')";
    if($result = $conn->query($sql)){
        
        header("Location: dashboard.php");
    }
}

$conn->close();
?>