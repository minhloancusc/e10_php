<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect. " . $e->getMessage());
}

try {
    $sql = "SELECT CategoryID,CategoryName,Description FROM categories";    
    $result = $conn->query($sql);   
    if ($result->rowCount() > 0) {        
        while ($row = $result->fetch()) {
            echo "CategoryID: " . $row["CategoryID"] . " - CategoryName: " . $row["CategoryName"] . "Description: " . $row["Description"] . "<br>";
        }        
        unset($result);
    } else {
        echo "No records found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
