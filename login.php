<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername = "172.31.9.48";  // Remote MySQL server IP
$username   = "root";           // MySQL user
$password   = "Admin@123";               // MySQL password
$dbname     = "payroll";        // DB name

// Create MySQL Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Read Form Data
$user = $_POST['username'];
$pass = $_POST['password'];

echo "Username: " . $user . "<br>";
echo "Password: " . $pass . "<br>";
?>

