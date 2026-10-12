<?php
require_once './myconfig/MyConnection.php';
require_once './models/RegionClass.php';
$conn = MyConnection::connectDatabase();
$region = new RegionClass();

//Delete
if (isset($_GET['action']) && ($_GET['action'] == 'delete')) {
    if ($region->deleteRegion($conn, $_GET['id'])) {
        echo "Delete ID " . $_GET['id'] . " successfully";
    } else {
        echo "Can't delete " . $_GET['id'];
    }
}
//Update
//Nhan lai gia tri region can update
if (isset($_GET['action']) && ($_GET['action'] == "edit")) {
    $rID = $_GET['id'];
    $rItem = $region->findRegionbyID($conn, $rID);
    //Update
    if (isset($_POST['updateregion'])) {
        $rID = $_POST['RegionID'];
        $rDes = $_POST['RegionDescription'];
        //echo $rID." ".$rDes;
        if ($region->updateRegion($conn, $rID, $rDes)) {
            echo "Update record successfully";
            header('location:mysqli_pro_region.php');
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
//Create
if (isset($_POST['insertregion'])) {
    $rID = $_POST['RegionID'];
    $rDes = $_POST['RegionDescription'];
    //echo $rID." ".$rDes;
    if ($region->addRegion($conn, $rID, $rDes)) {
        echo "New record created successfully";
        header('location:mysqli_pro_region.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
//Show form
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>        
        <form method="POST">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="2">Region Form</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Region ID</td>
                        <td><input type="text" name="RegionID"
                            <?php if (isset($_GET['action']) && ($_GET['action'] == "edit")) { ?>
                                       value="<?php echo $rItem['RegionID']; ?>"
                                       readonly
                                   <?php } ?>
                                   />
                        </td>
                    </tr>
                    <tr>
                        <td>Region Description</td>
                        <td><input  type="text" name="RegionDescription" value="<?php
                            if (isset($_GET['action']) && ($_GET['action'] == "edit")) {
                                echo $rItem['RegionDescription'];
                            }
                            ?>" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php if (isset($_GET['action']) && ($_GET['action'] == "edit")) { ?>
                                <input type="submit" value="Update" name="updateregion" />
                            <?php } else { ?>
                                <input type="submit" value="Insert" name="insertregion" />
                            <?php } ?>
                            <input type="reset" value="Reset" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php
        //Display data
        $result = $region->showAllRegion($conn);
        //Show Region data
        if (mysqli_num_rows($result) > 0) {
            ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Region ID</th>
                        <th>Region Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row["RegionID"] ?></td>
                            <td><?php echo $row["RegionDescription"] ?></td>
                            <td><a href="?action=edit&id=<?php echo $row["RegionID"] ?>">Edit</a></td>
                            <td><a href="?action=delete&id=<?php echo $row["RegionID"] ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </body>

</html>