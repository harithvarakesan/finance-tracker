<?php
include 'connection.php';

$username = htmlspecialchars($_SESSION["username"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$month = date('m');
$year = date('Y');
$sql = "SELECT * FROM $username WHERE MONTH(date) = $month AND YEAR(date) = $year";

$result = $conn->query($sql);

$incomeTotal = 0;
$expenseTotal = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transaction = $row['transaction'];
        $amount = $row['amount'];
        
        if ($transaction === 'income') {
            $incomeTotal += $amount;
        } elseif ($transaction === 'expense') {
            $expenseTotal += $amount;
        }
    }
} else {
    echo "<p>No data found.</p>";
}
$total= $incomeTotal + $expenseTotal;

$conn->close();
?>
