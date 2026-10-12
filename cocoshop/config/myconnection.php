<?php

class MyConnection {

    public static function connectDatabase() {
        //Connect database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "northwind";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }        
        return $conn;
    }
}
