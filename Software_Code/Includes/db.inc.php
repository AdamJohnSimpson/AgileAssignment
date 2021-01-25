<?php

$servername_db = "mysql80-afe9.euw2.cloud.ametnes.com";
$username_db = "KTWomToCcQ";
$password_db = "OFCREfcS96DmPrNOBSpu";
$name_db = "2191101310";

// Create connection
$conn = new mysqli($servername_db, $username_db, $password_db, $name_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>