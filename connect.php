<?php
$servername = "localhost";
$username = "root";
$password = "";
$databse = "cs_db";

// Create a new mysqli object and check if the connection is successful
$conn = new mysqli($servername, $username, $password, $databse);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
    echo "Connected successfully to the database!";
}
?>
