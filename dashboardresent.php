<?php
include 'connection.php';
session_start();


$username = htmlspecialchars($_SESSION["username"]);
$name = htmlspecialchars($_SESSION["name"]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set up the SQL query to fetch all rows from the table
$sql = "SELECT * FROM $username where transaction ='income' OR transaction ='expense' ORDER BY date DESC limit 5";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {
        $transaction = $row['transaction'];
        $date= $row['date'];
        $type= $row['type'];
        $description = $row['description'];
        $amount= $row['amount'];
        if($transaction=='income'){
        echo "
            <div class=amountin><h2>" . $date . "</h2><h1>₹" . $amount ."</h1></div>";
    
        }
        if($transaction=='expense'){
        echo "
            <div class=amountex><h2>" . $date . "</h2><h1>₹" . $amount ."</h1></div>";
        }
    }
} else {
    echo "<p>No messages found</p>";
}

$conn->close();
?>