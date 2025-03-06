<?php
session_start();
header("Content-Type: application/json");

// Check if the user is logged in
$response = ["logged_in" => isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true];

echo json_encode($response);
?>
