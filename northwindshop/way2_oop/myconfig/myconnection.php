<?php

class MyConnection {

    public static function connectDatabase() {
        //Connect database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "northwind";
        $conn = mysqli_connect($servername, $username, $password, $database) or die("Không thể kết nối CSDL" . mysqli_connect_error());
        return $conn;
    }
}
