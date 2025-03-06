<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo "<script>alert('You must log in to add items to your cart!'); window.location.href='login.html';</script>";
    exit();
}

// Ensure cart session exists
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Get product details from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = isset($_POST["quantity"]) ? (int)$_POST["quantity"] : 1;

    // Check if item already exists in the cart
    if (isset($_SESSION["cart"][$product_id])) {
        $_SESSION["cart"][$product_id]["quantity"] += $quantity;
    } else {
        $_SESSION["cart"][$product_id] = [
            "product_name" => $product_name,
            "price" => $price,
            "quantity" => $quantity
        ];
    }

    echo 'Item added to cart!';
}

?>