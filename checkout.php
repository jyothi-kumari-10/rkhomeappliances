<?php
session_start();

// Restrict access to logged-in users
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo "<script>alert('You must log in to proceed with checkout!'); window.location.href='login.html';</script>";
    exit();
}

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

// If cart is empty, redirect to cart page
if (empty($cart)) {
    echo "<script>alert('Your cart is empty!'); window.location.href='cart.php';</script>";
    exit();
}

$grand_total = 0;
foreach ($cart as $item) {
    $grand_total += $item["price"] * $item["quantity"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email =$_POST["email"];
    $address = $_POST["address"];
    $payment_method = $_POST["payment_method"];
    
    // Process order (In a real application, store this in the database)
    // For now, just clear the cart
    $_SESSION["cart"] = [];
    
    echo "<script>alert('Order placed successfully! Thank you, $name.'); window.location.href='index.html';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Checkout</h2>
        <h4 class="text-center">Grand Total: ₹<?php echo $grand_total; ?></h4>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select class="form-control" name="payment_method" required>
                    <option value="cod">Cash on Delivery</option>
                    <option value="online">Online Payment</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
            <a href="cart.php" class="btn btn-secondary">Back to Cart</a>
        </form>
    </div>
</body>
</html>
