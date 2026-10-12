<?php
    session_start();
    include_once './ketnoicsdl.php';
    if(!empty($_REQUEST['btnlogin'])){
        $uname = $_REQUEST['username'];
        $pword = $_REQUEST['password'];
        $sql = "select CustomerID,CompanyName from customers where CustomerID='$uname' and pass='$pword'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row;
            setcookie("uname", $row['CustomerID'], time()+60*60*24*100 );
            header("location:admin_dashboard.php");
        }else{
            echo "Vui long dang nhap lai";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?=(!empty($_COOKIE['uname']))? $_COOKIE['uname']:"" ?>
       <form name="flogin" method="POST" action="login.php">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="2">Login Form</th>                      
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" value="" /></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" value="" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Login" name="btnlogin" />
                            <input type="reset" value="Reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </body>
</html>
