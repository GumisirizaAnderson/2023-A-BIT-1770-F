<?php
session_start();
include 'includes/db.php';

// Add to cart functionality
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Get product details
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Add product to session cart
        $_SESSION['cart'][$productId] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId]['quantity'] + 1 : 1
        ];
    }
}

// Remove from cart functionality
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    unset($_SESSION['cart'][$productId]);
}

// Display Cart
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Cart</h1>
        <?php if (!empty($cart)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td><a href="cart.php?action=remove&id=<?php echo $item['id']; ?>" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total: $<?php echo number_format($total, 2); ?></h3>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
