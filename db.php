<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'db3cfrslj0sb5e';
$user = 'ulnrcogla9a1t';
$pass = 'yolpwow1mwr2';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "DB connected successfully!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
