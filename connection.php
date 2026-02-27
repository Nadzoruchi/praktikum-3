<?php

$host = '192.168.1.7';
$dbname = 'kampus';
$username = 'nadiaz';
$password = 'nadiaz27';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username,
$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>

