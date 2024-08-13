<?php
session_start(); 

include 'connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailid = $_POST["emailid"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE emailid = '$emailid' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $username = $row['username'];

        // Store data in session variables
        $_SESSION["name"] = $name;
        $_SESSION["username"] = $username;

        header("Location: dashboard.php"); // Redirect to dashboard page
        exit;
    } else {
        header("Location: login.html"); // Redirect back to login page
        exit;
    }
}

$conn->close();
?>