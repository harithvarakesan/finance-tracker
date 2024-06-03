<?php
include 'connection.php';
session_start();


$username = htmlspecialchars($_SESSION["username"]);
$name = htmlspecialchars($_SESSION["name"]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from the database
$sql = "SELECT * FROM $username WHERE transaction ='savings'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sname = $row['type'];
        $tamount = $row['description'];
        $amount = $row['amount'];
        
        echo "
        
        <div class='grid'>
                    <img src='dp.png'>
                    <h2>$sname</h2>
                    
                    <p>Hours</p>
                                        <h3 class='saved'>completed: $amount</h3><br>
                                        <h3 class='required'>Required: $tamount</h3>
                                        <input id='range' type='range' min='0' max='$tamount' value='$amount' disabled>
                                        </div>";
    }
} else {
    echo "<p>No messages found</p>";
}

$conn->close();
?>
                                        <!-- <h3 class='saved'>$amount</h3>
                                        <h3 class='required'>$tamount</h3> -->