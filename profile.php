<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location: login.html");
    exit;
}

$name = htmlspecialchars($_SESSION["name"]);
$username = htmlspecialchars($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
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
        <div class="profile">
            <div class="ptop"></div>
            <table id="showprofile">
                <img src="dp.png" style="height: 150px; border-radius: 100px; transform: translate(30%,-50%); border: 5px solid white;">
            </table>
        </div>
        <div class="pupdate">
            <h1>Update your profile here!</h1>
            <form action="profileupdate.php" method="post"  enctype="multipart/form-data">
                <label>Name</label><br>
                <input type="text" name="name"><br>
                <label>Mobile Number</label><br>
                <input type="number" name="mobile_no"><br>
                <label >Email</label><br>
                <input type="email" name="email"><br>
                <label>City</label><br>
                <input type="text" name="city"><br>
                <label>State</label><br>
                <input type="text" name="state"><br>
                <button>Save Update</button>
            </form>
        </div>
    </div>
    
</body>
</html>
<script>
    
function fetchprofile() {
    var showprofile = document.getElementById('showprofile');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'profilefetch.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            showprofile.innerHTML = xhr.responseText;

        }
    };
    xhr.send();
}
fetchprofile();
</script>
<style>
    
.profile{
    border: 5px solid black;
    border-radius: 20px;
    width: 500px;
    height: 90vh;
    position: absolute;
}
.pupdate{
    width: 500px;
    background-color: rgb(255, 255, 255);
    height: 90vh;
    position: absolute;
    right: 5vw;
    color: rgb(0, 0, 0);
    border-radius: 20px;
    padding: 10px;
    text-align: center;
}

.right{
    float: right;
    position: relative;
    width: 1200px;
    margin:0;
    margin-top:50px
}
</style>