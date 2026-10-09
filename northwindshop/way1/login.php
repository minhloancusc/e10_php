<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <?php
        if (isset($_GET['log']) && $_GET['log'] == "false") {
            ?>        
            <h2 style="color: red">Dang nhap sai, vui long dang nhap lai!</h2>
            <?php
        }
        ?>
        <form name="flogin" method="POST" action="login_process.php">
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
                            <input type="submit" value="Login" />
                            <input type="reset" value="Reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </body>
</html>
