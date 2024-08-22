<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftaran_kk";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM pendaftar WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: view_registrations.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>