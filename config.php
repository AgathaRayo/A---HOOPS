<?php
$host = 'localhost'; // Sesuaikan dengan host database Anda
$dbname = 'a_hoops'; // Nama database
$username = 'root'; // Username database Anda
$password = ''; // Password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>