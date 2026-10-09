<?php
$uname = $_POST['username'];
$pword = $_POST['password'];

//echo "Username: $uname, password: $pword";
if($uname=="admin" && $pword=="123"){
    header("location:admin_dashboard.php");
}else{
    header("location:login.php?log=false");
}


