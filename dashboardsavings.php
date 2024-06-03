<?php
include 'connection.php';
session_start();


$username = htmlspecialchars($_SESSION["username"]);
$name = htmlspecialchars($_SESSION["name"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $username WHERE transaction ='savings'";
$result = $conn->query($sql);
echo"<h1>SAVINGS</h1>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sname = $row['type'];
        $tamount = $row['description'];
        $amount = $row['amount'];
        
        echo "
        
        <h2>" . $sname . "</h2>
        <input  id='range' type='range' min='0' max=". $tamount ." value=". $amount ." disabled>";
    }
} else {
    echo "<p>No messages found</p>";
}

$conn->close();
?>
