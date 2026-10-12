<?php
session_start();
if(empty($_SESSION['username'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Admin Dashboard</h1>
        <h2>Hello <?= $_SESSION['username']['CompanyName'] ?>!</h2>
        <a href="shippers.php">Shipper</a>
    </body>
</html>
