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
$sql = "SELECT * FROM users WHERE username ='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $emailid = $row['emailid'];
        $city = $row['city'];
        $state = $row['state'];
        $mobile_no = $row['mobile_no.'];
        $image = $row['image'];
        echo "
        <tr>
            <th>NAME :</th>
            <td>" . $name . "</td>
        </tr>
        <tr>
            <th>EMAIL :</th>
            <td>" . $emailid . "</td>
        </tr>
        <tr>
            <th>CITY :</th>
            <td>" . $city . "</td>
        </tr>
        <TR>
            <th>STATE :</th>
            <td>" . $state . "</td>
        </TR>
        <tr>
            <th>MOBILE NUMBER:</th>
            <td>" . $mobile_no . "</td>
        </tr>";
    }
} else {
    echo "<p>No messages found</p>";
}

$conn->close();
?>
