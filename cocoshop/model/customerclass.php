<?php

class CustomerClass {

    public function checkLogin($conn, $username, $password) {
        $sql = "select CustomerID,CompanyName from customers where CustomerID='$username' and pass='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    
}
