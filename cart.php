<?php
session_start();

// Restrict access to logged-in users
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo "<script>alert('You must log in to view your cart!'); window.location.href='login.html';</script>";
    exit();
}

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center" >Shopping Cart</h2>
        <?php if (empty($cart)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <table class="table">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php 
                $grand_total = 0;
                foreach ($cart as $product_id => $item) : 
                    $total_price = $item["price"] * $item["quantity"];
                    $grand_total += $total_price;
                ?>
                <tr>
                    <td><?php echo $item["product_name"]; ?></td>
                    <td>₹<?php echo $item["price"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>₹<?php echo $total_price; ?></td>
                    <td><button class="btn btn-danger" onclick="removeFromCart(<?php echo $product_id; ?>)">Remove</button></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <h3>Grand Total: ₹<?php echo $grand_total; ?></h3>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
            <a href="index.html" class="btn btn-success">Add more items</a>
        <?php endif; ?>
    </div>
    <script>
function removeFromCart(productId) {
    let formData = new FormData();
    formData.append("product_id", productId);

    fetch("remove_from_cart.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result); 
        location.reload(); // Refresh cart after removal
    })
    .catch(error => console.error("Error:", error));
}
</script>


</body>
</html>
