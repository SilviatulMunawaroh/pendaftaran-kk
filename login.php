<?php
session_start();

// Periksa apakah admin sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: view_registrations.php");
    exit;
}

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Contoh username dan password, sebaiknya gunakan database dan hashing password untuk keamanan lebih
    $admin_user = "admin";
    $admin_pass = "admin123"; // Gunakan hashing password untuk keamanan lebih

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['loggedin'] = true;
        header("Location: view_registrations.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-header h2 {
        font-size: 24px;
        font-weight: bold;
        color: #343a40;
    }

    .login-container .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .alert {
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Login Admin</h2>
        </div>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>