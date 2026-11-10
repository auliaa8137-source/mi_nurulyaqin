<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Username dan password wajib diisi.";
    } else {
        $stmt = mysqli_prepare(
            $koneksi,
            "SELECT id, username, password FROM admin WHERE username = ? LIMIT 1"
        );

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($hasil);

        if ($admin && password_verify($password, $admin['password'])) {
            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Admin | MI Nurul Yaqin Tampumia</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: linear-gradient(135deg, #0d5934, #187747, #e4bd62);
}

.login-container {
    width: 100%;
    max-width: 420px;
    background: #fff;
    padding: 40px 35px;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    text-align: center;
}

.logo-sekolah {
    text-align: center;
    margin-bottom: 20px;
}

.logo-sekolah img {
    width: 115px;
    height: 115px;
    object-fit: contain;
    border-radius: 50%;
    background: white;
    padding: 5px;
}

h2 {
    color: #145c37;
    font-size: 23px;
    margin-bottom: 8px;
}

.subtitle {
    color: #777;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 28px;
}

.form-group {
    text-align: left;
    margin-bottom: 20px;
}

label {
    display: block;
    color: #333;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 9px;
}

input {
    width: 100%;
    padding: 14px;
    border: 1px solid #ddd;
    border-radius: 9px;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
}

input:focus {
    border-color: #187747;
    box-shadow: 0 0 0 3px rgba(24,119,71,0.12);
}

button {
    width: 100%;
    padding: 14px;
    background: #176b3a;
    color: white;
    border: none;
    border-radius: 9px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 5px;
}

button:hover {
    background: #0d512b;
    transform: translateY(-2px);
}

.error {
    background: #fff0f0;
    color: #c62828;
    padding: 12px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 18px;
}

.back-link {
    display: inline-block;
    margin-top: 24px;
    color: #176b3a;
    text-decoration: none;
    font-size: 13px;
}

.back-link:hover {
    text-decoration: underline;
}

.footer {
    margin-top: 25px;
    padding-top: 18px;
    border-top: 1px solid #eee;
    color: #999;
    font-size: 12px;
}

@media (max-width: 480px) {
    .login-container {
        padding: 30px 22px;
    }

    h2 {
        font-size: 20px;
    }
}
</style>
</head>

<body>

<div class="login-container">

    <div class="logo-sekolah">
    <img src="../assets/images/LOGO.jpeg"
         alt="Logo MI Nurul Yaqin Tampumia">
</div>
    <h2>LOGIN ADMIN</h2>

    <p class="subtitle">
        MI Nurul Yaqin Tampumia<br>
        Silakan masuk untuk mengelola website sekolah.
    </p>

    <?php if ($error !== ''): ?>
        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <div class="form-group">
            <label>Username</label>
            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit">MASUK SEKARANG</button>

    </form>

    <a href="../index.php" class="back-link">
        ← Kembali ke Halaman Utama
    </a>

    <div class="footer">
        © 2026 MI Nurul Yaqin Tampumia
    </div>

</div>

</body>
</html>