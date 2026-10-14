<?php

class ProductClass {

    public function showAllProducts($conn) {
        $sql = "select ProductID,ProductName,UnitPrice,UnitsInStock,imageURL from products";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function findProductbyID($conn, $productid) {
        $sql = "select ProductID,ProductName,UnitPrice,UnitsInStock,imageURL from products where  ProductID = $productid";
        $result = $conn->query($sql);
        //echo $result->num_rows;
        return $result->fetch_assoc();
    }
}
