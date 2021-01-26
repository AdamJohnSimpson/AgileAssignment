<?php

$servername_db = 'localhost';
$username_db = 'teseuser';
$password_db = 'pass123';
$name_db = 'teseuser';
$port = 56570;

// Create connection
$conn = new mysqli($servername_db, $username_db, $password_db, $name_db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>