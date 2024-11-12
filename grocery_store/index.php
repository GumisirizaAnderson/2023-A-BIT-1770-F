<?php
include 'includes/db.php';

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Online Grocery Store</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="assets/images/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text">$<?php echo number_format($product['price'], 2); ?></p>
                            <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
