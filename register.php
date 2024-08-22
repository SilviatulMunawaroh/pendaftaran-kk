<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftaran_kk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO pendaftar (nama_lengkap, nik, alamat, tanggal_lahir, no_hp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['nama_lengkap'], $_POST['nik'], $_POST['alamat'], $_POST['tanggal_lahir'], $_POST['no_hp']);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: index.html");
exit();
?>