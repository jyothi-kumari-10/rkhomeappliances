<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo "<script>alert('You must log in to modify your cart!'); window.location.href='login.html';</script>";
    exit();
}

// Check if a product ID is provided
if (isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];

    // Remove the item from session cart
    if (isset($_SESSION["cart"][$product_id])) {
        unset($_SESSION["cart"][$product_id]);
        echo "Item removed from cart!";
    } else {
        echo "Item not found in cart!";
    }
} else {
    echo "Invalid request!";
}
?>
