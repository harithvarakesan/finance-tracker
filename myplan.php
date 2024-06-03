
<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location: login.html");
    exit;
}

$name = htmlspecialchars($_SESSION["name"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="myplan.css">
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
        <form class="piechart" action="newsavings.php" method="post">
            <h1>Start New Savings</h1>
            <input type="text" placeholder="Savings Name" name="sname"><br>
            <input type="number" placeholder="Total amount for savings" name="amount"><br>
            <button type="submit">Add</button>
        </form>
        <form class="piechart" action="updatesavings.php" method="post">
            <h1>Add to Savings</h1>
            <input type="text" placeholder="Savings Name" name="sname">
            <input type="number" placeholder="Add amount to savings" name="amount">
            <button type="submit">Update</button>
        </form>
            <div id="plans">
                <div class="grid">
                    <img src="dp.png">
                    <h2>vehichle</h2>
                    <h3 class="saved">$500</h3>
                    <h3 class="required">$1000</h3>
                    <input id="range" type="range" min="0" max="100" value="50" disabled>
                </div>
                <div class="grid"></div>
                <div class="grid"></div>
                <div class="grid"></div>
                <div class="grid"></div>
                <div class="grid"></div>
            </div>
    </div>
</body>
</html>
<script>
        
function fetchsavings() {
    var showsavings = document.getElementById('plans');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'myplanfetch.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            showsavings.innerHTML = xhr.responseText;

        }
    };
    xhr.send();
}
fetchsavings();
    </script>
<style>
#plans{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px,350px));
    gap:25px;
}
#range{
  background-color: red;
  color:red;
  background:red;
}
.piechart{
    width: 540px;
    height: 300px;
    background-color: rgb(255, 255, 255);
    margin: 10px;
    border-radius: 20px;
    margin-top: 40px;
    margin-bottom: 30px;
    display: inline-block;
    text-align:center;
}
.piechart input{
    width:60%;
    height:30px;
    padding-left: 20px;
    margin: 10px;
    border-radius: 10px;
}
.piechart button{
    width: 50%;
    height: 30px;
    color: white;
    background-color: black;
    margin: 10px;
    border-radius: 10px;
}
.piechart button:hover{
    color: black;
    background-color: rgb(119, 249, 232);
    transition: 0.3s;
}
.right{
width: 80vw;
float: right;
overflow:scroll;
height:100vh;
}
.right::-webkit-scrollbar{
    background-color: transparent;
}
.grid{
    background-color: white;
    height: 200px;
    border-radius: 10px;
    position: relative;
}
.grid img{
    height: 60px;
    border-radius: 50px;
    display: inline;
    margin-left: 10px;
    margin-top: 10px;
}
.grid h2{
    display: inline-block;
}
.saved{
    position: absolute;
    bottom: 20%;
    left: 10%;
}
.required{
    position: absolute;
    bottom: 20%;
    right: 10%;
}
.grid input{
    position: absolute;
    bottom: 10%;
    width: 70%;
    left: 15%;
}

</style>