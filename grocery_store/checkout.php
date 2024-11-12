<?php
session_start();
$total = 0;
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}

foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Checkout</h1>
        <h3>Total: $<?php echo number_format($total, 2); ?></h3>
        <form action="payment.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
