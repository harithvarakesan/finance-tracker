<?php
session_start();


include 'connection.php';

$username = htmlspecialchars($_SESSION["username"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sname = $_POST["sname"];
    $amount = $_POST["amount"];
    
    $sql = "INSERT INTO `$username` (`transaction`, `type`, `description`) VALUES ('savings', '$sname', '$amount')";

    if($result = $conn->query($sql)){
        
        // header("Location: myplan.php");
        header("Location: myplantask.php");
    }
}

$conn->close();
?>