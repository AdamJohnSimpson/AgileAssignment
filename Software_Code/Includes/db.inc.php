<?php

$servername_db = 'localhost';
$username_db = 'testuser';
$password_db = 'password123';
$name_db = 'testdb';
$port = 56570;

// Create connection
$conn = new mysqli($servername_db, $username_db, $password_db, $name_db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>