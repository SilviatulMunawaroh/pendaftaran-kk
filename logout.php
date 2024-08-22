<?php
session_start();
$_SESSION = []; // Menghapus semua data sesi
session_destroy(); // Menghancurkan sesi
header("Location: index.html"); // Mengarahkan ke beranda
exit;
?>