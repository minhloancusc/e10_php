<?php
include_once './ketnoicsdl.php';
//Insert new Shipper
if (!empty($_REQUEST['create'])) {
    $cname = $_REQUEST['companyName'];
    $phone = $_REQUEST['phone'];
    $sql = "insert into shippers (CompanyName,Phone) values ('$cname','$phone')";
    if (mysqli_query($conn, $sql)) {
        echo "<script> alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//Delete shipper by ShipperID
if ((!empty($_REQUEST['action'])) && ($_REQUEST['action'] == 'delete')) {
    if (!empty($_REQUEST['idshipper'])) {
        $iddelete = $_REQUEST['idshipper'];
        $sql = "delete from shippers where ShipperID = $iddelete";
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Delete record created successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
//Find and Edit Shipper
if ((!empty($_REQUEST['action'])) && ($_REQUEST['action'] == 'edit')) {
    echo 'Update du lieu';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>        
    </head>
    <body>
        <form method="POST">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="">Shippers Form</th>                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Company Name:</td>
                        <td><input type="text" name="companyName" value="" required /></td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td><input type="text" name="phone" value="" required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Create" name="create" />
                            <input type="reset" value="Reset" name="reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <br/>
        <?php
        $sql = "Select ShipperID,CompanyName,Phone from shippers";
        $result = mysqli_query($conn, $sql);
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Shipper ID</th>
                    <th>Company Name</th> 
                    <th>Phone</th>
                    <th>Edit</th>.
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>    
                        <tr>
                            <td><?= $row["ShipperID"] ?></td>
                            <td><?= $row["CompanyName"] ?></td>     
                            <td><?= $row["Phone"] ?></td>
                            <td><a href="shippers.php?action=edit&idshipper=<?= $row["ShipperID"] ?>"><img src="images/iconedit.png" width="20px"/></a></td>
                            <td><a href="shippers.php?action=delete&idshipper=<?= $row["ShipperID"] ?>"><img src="images/icondelete.png" width="20px"/></a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($conn);
                ?>      
            </tbody>
        </table>
    </body>
</html>
