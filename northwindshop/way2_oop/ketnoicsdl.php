<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT CategoryID,CategoryName,Description FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {   
    while ($row = $result->fetch_assoc()) {
        echo "CategoryID: " . $row["CategoryID"] . " - CategoryName: " . $row["CategoryName"] . "Description: " . $row["Description"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
