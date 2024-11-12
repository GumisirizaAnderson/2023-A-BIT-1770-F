<?php
$host = 'localhost';
$dbname = 'grocery_store';
$username = 'root';
$password = ''; // Leave it empty if using XAMPP, WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
