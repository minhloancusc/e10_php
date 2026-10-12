<?php
class ShipperClass {
    private $shipperID;
    private $companyName;
    private $phone;
    
    public function showAllShipper($conn) {
        $sql = "select ShipperID,CompanyName,Phone from shippers";
        $result = $conn->query($sql);
        return $result;
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
