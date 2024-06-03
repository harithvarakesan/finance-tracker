
<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location: login.html");
    exit;
}

$username = htmlspecialchars($_SESSION["username"]);
$name = htmlspecialchars($_SESSION["name"]);
include 'calculate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cashflow</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cashflow.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="left">
        <h2>BUDGET TRACKER</h2>
        <img src="dp.png">
        
        <h2 style="text-align: center; color:black;"><b><?php echo $name; ?></b></h2>
        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="cashflow.php">CASHFLOW</a></li>
            <li><a href="myplan.php">MY PLAN</a></li>
            <li><a href="profile.php">PROFILE</a></li>
        </ul>
        <button><b><a  href="logout.php"  style="color: black;">LOGOUT</a></b></button>
    </div>

    <div class="right">
        <div class="piechart-container"> 
            <canvas id="donutChart" ></canvas>
        </div>
        <div class="newtrans">
            <h2>ADD TRANSACTIONS</h2>
                <form class="add" action="addtransaction.php" method="POST">    
                    <input type="text" placeholder="Transaction" list="amount" name="transaction" required><br>
                    <datalist id="amount">
                        <option value="income">
                        <option value="expense">
                    </datalist>
                    <input type="date" name="date" required><br>
                    <input type="text" list="type" placeholder="Type of Transaction" name="type" required><br>
                    <datalist id="type">
                        <option value="salary">
                        <option value="food">
                        <option value="rent">
                        <option value="vehicle">
                        <option value="education">
                        <option value="movie">
                        <option value="others">
                    </datalist>
                    <input type="number" placeholder="Amount" name="amount" required><br>
                    <input type="text" placeholder="Description" name="description"><br>
                    
                    <button >ADD+</button><p>.</p>
                </form>
            </div><br>
        <button onclick="income()"><b>INCOME</b></button>
        <button onclick="all()"><b>ALL</b></button>
        <button onclick="expense()"><b>EXPENSE</b></button>
        <table  id="transaction_history">
        </table>
    </div>
</body>
</html>
<script>
    
var donutChartContainer = document.getElementById('donutChart');


var donutChart = new Chart(donutChartContainer, {
    type: 'doughnut',
    data: {
        labels: ['Income', 'Expense'],
        datasets: [{
            data: [<?php echo $incomeTotal; ?>, <?php echo $expenseTotal; ?>],
            backgroundColor: ['#36A2EB', '#FF6384']
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: true,
        },
        title: {
            display: true,
            text: 'Income, Expense'
        }, plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});



function income() {
    fetchMessages("income");
}

function expense() {
    fetchMessages("expense");
}
function all() {
    fetchMessages("all");
}

function fetchMessages(show) {
    var transactionarea = document.getElementById('transaction_history');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'cashflowtable.php?show=' + show, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            transactionarea.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}


fetchMessages();
</script>
<style>
    .right{
    overflow: scroll;
    height: 100vh;
}
.right::-webkit-scrollbar{
    background-color: transparent;
}
.piechart-container {
    width: 400px;
    height: 350px;
    background-color: rgb(255, 255, 255);
    margin: 10px;
    border-radius: 20px;
    margin-top: 40px;
    margin-bottom: 30px;
    display: inline-block;
    position: relative;
    padding-left:40px;
 }
.right button{
    background-color: transparent;
    border-width: 0;
    margin: 10px;
    cursor: pointer;
}
.right table{
    background-color: white;
    width: 96%;
    border-radius: 10px;
    text-align: center;
}
.newtrans{
    width: 550px;
    height: 350px;
    background-color: white;
    margin: 10px;
    border-radius: 20px;
    display:inline-block;
}
.newtrans h2{
    text-align: center;
}
.add{
    margin-left: 20%;
    
}
.add input{
    width:70%;
    height:30px;
    margin-top:10px;
    border-radius:10px;
    font-size:15px;
    padding-left:30px;
}
.add button{
    width:70%;
    height:30px;
    margin-top:20px;
    margin-left:15px;
    border-radius:10px;
    font-size:15px;
    padding-left:30px;
    background-color:black;
    color:white;
}
.add button:hover{
    background-color:white;
    color:black;
    border:3px solid black;
    transition:0.5s;
}
</style>