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

// Query untuk mendapatkan data pendaftar
$sql = "SELECT id, nama_lengkap, nik, alamat, tanggal_lahir, no_hp, reg_date FROM pendaftar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar Kartu Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        padding-top: 56px;
        /* Navbar height */
    }

    .container {
        flex: 1;
    }

    .hero {
        background: url('path-to-your-hero-image.jpg') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 0;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .navbar-custom {
        padding-left: 20px;
        padding-right: 20px;
    }

    .navbar-nav .nav-link {
        padding-left: 15px;
        padding-right: 15px;
    }

    footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
        margin-top: auto;
    }

    footer p {
        margin: 0;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top navbar-custom">
        <a class="navbar-brand text-white" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5 pt-5 mb-5">
        <h2 class="mb-4">Data Pendaftar Kartu Keluarga</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>No. HP</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data dari setiap row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"]. "</td>
                                <td>" . $row["nama_lengkap"]. "</td>
                                <td>" . $row["nik"]. "</td>
                                <td>" . $row["alamat"]. "</td>
                                <td>" . $row["tanggal_lahir"]. "</td>
                                <td>" . $row["no_hp"]. "</td>
                                <td>" . $row["reg_date"]. "</td>
                                <td>
                                    <a href='edit_registration.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_registration.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada pendaftar yang ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white">
        <p>&copy; 2024 Admin Panel. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>