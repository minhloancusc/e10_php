<?php
session_start();
include_once './config/myconnection.php';
include_once './model/customerclass.php';
$conn = MyConnection::connectDatabase();
$customer = new CustomerClass();
if (!empty($_REQUEST['btnlogin'])) {
    $uname = $_REQUEST['username'];
    $pword = $_REQUEST['password'];
    if ($customer->checkLogin($conn, $uname, $pword)) {
        $_SESSION['username'] = $uname;
        header("location:./admin/admin_dashboard.php");
    } else {
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
