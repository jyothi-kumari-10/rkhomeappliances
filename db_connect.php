<?php
session_start(); // Start the session

$host = "localhost";
$user = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "rkhome";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>