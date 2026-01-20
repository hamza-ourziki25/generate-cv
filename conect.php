<?php
$host = 'localhost';
$dbname = 'cv_creator';
$username = 'root';    // Default for XAMPP
$password = '';        // Default for XAMPP (empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>