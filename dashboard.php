<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Dashboard</title>

    <style>
        
    </style>
</head>
<body class="xyz">
    <div class="dashboard-container text-center" id="dashboard">
        <h2>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $_SESSION["user_email"]; ?></p>
        <p><strong>Your Customer ID:</strong> <?php echo $_SESSION["user_id"]; ?></p>
        <button class="btn"><a href="logout.php" style="color:#FFFFFF">Logout</a></button>
    </div>
    
</body>
</html>
