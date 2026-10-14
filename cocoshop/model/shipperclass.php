<?php
class ShipperClass {
    private $shipperID;
    private $companyName;
    private $phone;
    
    public function showAllShipper($conn) {
        $sql = "select ShipperID,CompanyName,Phone from shippers";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function addShipper($conn, $companyName, $phone) {
        $sql = "insert into shippers (CompanyName,Phone) values ('$companyName','$phone')";
        if ($conn->query($sql)) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function deleteShipper($conn, $shipperid) {
        $sql = "delete from shippers where ShipperID = $shipperid";
        if ($conn->query($sql)) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function updateShipper($conn, $shipperid, $companyNameNew, $phoneNew) {
        $sql = "update shippers set CompanyName = '$companyNameNew', Phone = '$phoneNew' where  ShipperID = $shipperid";
        if ($conn->query($sql)) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function findShipperbyID($conn, $shipperid) {
        $sql = "select ShipperID,CompanyName,Phone from shippers where  ShipperID = $shipperid";
        $result = $conn->query($sql);
        echo $result->num_rows;
        return $result->fetch_assoc();
    }

    public function findShipperbyName($conn, $keyword) {
        $sql = "ShipperID,CompanyName,Phone from shippers where CompanyName like '%$keyword%'";
        $result = $conn->query($sql);
        $listShipper = array();
        while ($row = $result->fetch_assoc()) {
            $listShipper[] = $row;
        }
        return $listShipper;
    }
    
    public function get_shipperID() {
        return $this->shipperID;
    }

    public function get_companyName() {
        return $this->companyName;
    }

    public function get_phone() {
        return $this->phone;
    }

    public function set_shipperID($shipperID): void {
        $this->shipperID = $shipperID;
    }

    public function set_companyName($companyName): void {
        $this->companyName = $companyName;
    }

    public function set_phone($phone): void {
        $this->phone = $phone;
    }

}
