<?php
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

// Mendapatkan data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$nik = $_POST['nik'];
$alamat = $_POST['alamat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$no_hp = $_POST['no_hp'];

// Menyimpan data ke database
$sql = "INSERT INTO pendaftar (nama_lengkap, nik, alamat, tanggal_lahir, no_hp)
VALUES ('$nama_lengkap', '$nik', '$alamat', '$tanggal_lahir', '$no_hp')";

if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>