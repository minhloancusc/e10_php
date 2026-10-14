<?php
session_start();
if(empty($_SESSION['username'])){
    header("location:login.php");
}
include_once '../config/myconnection.php';
include_once '../model/shipperclass.php';
$conn = MyConnection::connectDatabase();
$shipper = new ShipperClass();
//Insert new Shipper
if (!empty($_REQUEST['createshipper'])) {
    $cname = $_REQUEST['companyName'];
    $phone = $_REQUEST['phone'];      
    if ($shipper->addShipper($conn, $cname, $phone)) {
        echo "<script> alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//Delete shipper by ShipperID
if ((!empty($_REQUEST['action'])) && ($_REQUEST['action'] == 'delete')) {
    if (!empty($_REQUEST['idshipper'])) {
        $iddelete = $_REQUEST['idshipper'];
        if ($shipper->deleteShipper($conn, $iddelete)) {
            echo "<script> alert('Delete record created successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
//Find and Edit Shipper
if ((!empty($_REQUEST['action'])) && ($_REQUEST['action'] == 'edit')) {
    if (!empty($_REQUEST['idshipper'])) {
        $idedit = $_REQUEST['idshipper'];                        
        $shipper_update = $shipper->findShipperbyID($conn, $idedit);
    }
}
if (!empty($_REQUEST['editshipper'])) {
    $idedit = $_REQUEST['shipperID'];
    $nameedit = $_REQUEST['companyName'];
    $phoneedit = $_REQUEST['phone'];    
    if ($shipper->updateShipper($conn, $idedit, $nameedit, $phoneedit)) {
        echo "<script> alert('Update record created successfully');</script>";
        header("location:shippers.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shippers</title>      
    </head>
    <body>
        <h2>Hello <?= $_SESSION['username'] ?>!</h2>
        <a href="signout.php">Logout</a>
        <form method="POST">
            <input type="hidden" name="shipperID" value="<?= (!empty($shipper_update)) ? $shipper_update['ShipperID'] : "" ?>" required />
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="">Shippers Form</th>                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Company Name:</td>
                        <td><input type="text" name="companyName" value="<?= (!empty($shipper_update)) ? $shipper_update['CompanyName'] : "" ?>" required /></td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td><input type="text" name="phone" value="<?= (!empty($shipper_update)) ? $shipper_update['Phone'] : "" ?>" required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php if (empty($shipper_update)) { ?>
                                <input type="submit" value="Create" name="createshipper" />
                            <?php } else { ?>
                                <input type="submit" value="Update" name="editshipper" />
                            <?php } ?>
                            <input type="reset" value="Reset" name="reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <br/>
        <?php
        $result = $shipper->showAllShipper($conn);
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
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>    
                        <tr>
                            <td><?= $row["ShipperID"] ?></td>
                            <td><?= $row["CompanyName"] ?></td>     
                            <td><?= $row["Phone"] ?></td>
                            <td><a href="shippers.php?action=edit&idshipper=<?= $row["ShipperID"] ?>"><img src="../images/iconedit.png" width="20px"/></a></td>
                            <td><a href="shippers.php?action=delete&idshipper=<?= $row["ShipperID"] ?>"><img src="../images/icondelete.png" width="20px"/></a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>      
            </tbody>
        </table>
    </body>
</html>
