<?php

class RegionClass {

    private $regionID;
    private $regionDescription;

    public function showAllRegion($conn) {
        $sql = "select RegionID,RegionDescription from Region";
        $result = $conn->query($sql);
        return $result;
    }

    public function addRegion($conn, $regionid, $regionDes) {
        try {
            $sql = "insert into region (RegionID,RegionDescription) values ($regionid,'$regionDes')";
            if ($conn->query($sql)) {
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            error_log("Lỗi SQL: " . $e->getMessage());
            return false;
        }
    }

    public function deleteRegion($conn, $regionid) {
        $sql = "delete from region where RegionID = $regionid";
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRegion($conn, $regionid, $regionDesNew) {
        $sql = "update region set RegionDescription = '$regionDesNew' where RegionID = $regionid";
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function findRegionbyID($conn, $regionid) {
        $sql = "select RegionID,RegionDescription from Region where RegionID = $regionid";
        $result = $conn->query($sql);
        echo mysqli_num_rows($result);
        return $result->fetch_assoc();
    }

    public function findRegionbyName($conn, $keyword) {
        $sql = "select RegionID,RegionDescription from Region where RegionDescription like '%$keyword%'";
        $result = $conn->query($sql);
        $listRegion = array();
        while ($row = $result->fetch_assoc()) {
            $listRegion[] = $row;
        }
        return $listRegion;
    }

    public function get_regionID() {
        return $this->regionID;
    }

    public function get_regionDescription() {
        return $this->regionDescription;
    }

    public function set_regionID($regionID): void {
        $this->regionID = $regionID;
    }

    public function set_regionDescription($regionDescription): void {
        $this->regionDescription = $regionDescription;
    }
}
