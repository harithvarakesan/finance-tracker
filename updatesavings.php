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
    
    $sql = "SELECT amount FROM $username WHERE type='$sname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentAmount = $row['amount'];
        $newAmount = $currentAmount + $amount;

        $sql1 = "UPDATE $username SET amount = '$newAmount' WHERE type='$sname'";
        $result1 = $conn->query($sql1);

        if ($result1 === TRUE) {
            header("Location: myplan.php");

        }
    } else {
        echo "ERROR : No matching records found. Please go back and recheck the savings name.";
    }
}


$conn->close();
?>