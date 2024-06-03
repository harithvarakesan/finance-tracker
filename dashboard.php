
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
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <div class="left">
        <h2>BUDGET TRACKER</h2>
        <img src="dp.png"><br>
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
        <div id="piechart">
        </div><hr>
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
                    
                    <button >ADD+</button>
                </form>
        </div>
        <div class="transaction">
            <h2>RECENT TRANSACTIONS</h2>
            <div id="history">
            </div>
        </div>
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

    function fetchMessages() {
        var resenttransaction = document.getElementById('history');
    
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'dashboardresent.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                resenttransaction.innerHTML = xhr.responseText;
    
            }
        };
        xhr.send();
    }
    function fetchsavings() {
        var resenttransaction = document.getElementById('piechart');
    
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'dashboardsavings.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                resenttransaction.innerHTML = xhr.responseText;
    
            }
        };
        xhr.send();
    }
    fetchsavings();
    fetchMessages();
    </script>


<style>
.right{
    width: 80vw;
    float: right;
    overflow: scroll;
    height: 100vh;
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
#piechart{
    width: 420px;
  height: fit-content;
    max-height:350px;
    background-color: rgb(255, 255, 255);
    margin: 10px;
    border-radius: 20px;
    margin-top: 40px;
    margin-bottom: 30px;
    display: inline-block;
    position: relative;
    padding-left:60px;
    padding-right:60px;
    overflow:scroll;
    white-space: nowrap;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
#piechart::-webkit-scrollbar, .right::-webkit-scrollbar{
    background-color: transparent;
}
#piechart input{
    width:90%;
}
.transaction{
    text-align: center;
    background-color: white;
    width: 550px;
    height: 450px;
    display: inline-block;
    margin: 10px;
    border-radius: 20px;
}
#history{
    width: 430px;
    margin: 50px;
}
.amount h2{
    float: left;
    padding-left: 20px;
}
.amount h1{
    padding-right: 20px;
}
.newtrans{
    width: 550px;
    height: 450px;
    background-color: white;
    float: left;
    margin: 10px;
    border-radius: 20px;
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
    margin-top:20px;
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
.amountin{
    height: 50px;
    background-color: rgba(12, 223, 58, 0.75);
    width: 90%;
    text-align: left;
    color: white;
    padding-left: 30px;
    padding-right: 30px;
    border-radius:20px;
}
.amountex{
    height: 50px;
    background-color: rgba(223, 47, 12,0.75);
    width: 90%;
    text-align: left;
    color: white;
    padding-left: 30px;
    padding-right: 30px;
    border-radius:20px;
}
.amountin h2, .amountex h2{
    float:right;
}

    </style>