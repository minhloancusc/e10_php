<?php
include_once '../config/myconnection.php';
include_once '../model/shipperclass.php';
$conn = MyConnection::connectDatabase();
$shipper = new ShipperClass();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $shipperlist = $shipper->showAllShipper($conn);
        if ($shipperlist->num_rows > 0) {
            while ($row = $shipperlist->fetch_assoc()) {
                echo "ShipperID: " . $row["ShipperID"] . " - CompanyName: " . $row["CompanyName"] . "Phone: " . $row["Phone"] . "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </body>
</html>
