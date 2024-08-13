<?php
include 'connection.php';
session_start();


$username = htmlspecialchars($_SESSION["username"]);
$name = htmlspecialchars($_SESSION["name"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM $username WHERE transaction='income' OR transaction='expense' ORDER BY date DESC";

if (isset($_GET["show"])) {
    $show = $_GET["show"];

    if ($show == "income") {
        $sql = "SELECT * FROM $username WHERE transaction='income' ORDER BY date DESC";
    }
    else if ($show == "expense") {
        $sql = "SELECT * FROM $username WHERE transaction='expense' ORDER BY date DESC";
    }
    else if($show == "all"){
        $sql = "SELECT * FROM $username WHERE transaction='income' OR transaction='expense' ORDER BY date DESC";
    }
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "
    <tr>
        <th>TYPE<hr></th>
        <th>DATE<hr></th>
        <th>TYPE<hr></th>
        <th>DESCRIPTION<hr></th>
        <th>AMOUNT<hr></th>
    </tr>
    ";
    while ($row = $result->fetch_assoc()) {
        $transaction = $row['transaction'];
        $date= $row['date'];
        $type= $row['type'];
        $description = $row['description'];
        $amount= $row['amount'];
        
        echo "
            <tr>
                <td>" . $transaction . "</td>
                <td>" . $date . "</td>
                <td>" . $type . "</td>
                <td>" . $description . "</td>
                <td>" . $amount . "</td>
            </tr>
        ";
    }
} else {
    echo "<p>No messages found</p>";
}

$conn->close();
?>