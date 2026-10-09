<!DOCTYPE html>
<?php
if (isset($_REQUEST['btnLogin'])) {
    $uname = $_REQUEST['username'];
    $pword = $_REQUEST['password'];
    $role = $_REQUEST['role'];
    if (!preg_match("/^[a-zA-Z-']*$/", $uname)) {
        $nameErr = "Only letters allowed";
        echo $nameErr;
    } else {
        if ($uname == "admin" && $pword == "123") {
            header("location:admin_dashboard.php");
        } else {
            echo $role;
            echo "Dang nhap sai, vui long dang nhap lai!";
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
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
                        <td><input type="text" name="username" value="" required="true" /></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" value="" required="true" /></td>
                    </tr>
                    <tr>
                        <td>Role: </td>
                        <td>
                            <input type="radio" name="role" value="staff" checked="true">Staff
                            <input type="radio" name="role" value="admin">Admin
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="btnLogin" value="Login" />
                            <input type="reset" value="Reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </body>
</html>
