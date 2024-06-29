<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$username = $_SESSION['username'];

// Ambil informasi pengguna dari database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan.";
    exit();
}

// Proses form ubah password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi password lama
    if (!password_verify($password_lama, $user['password'])) {
        $error_password = "Password lama salah.";
    } elseif ($password_baru != $konfirmasi_password) {
        $error_password = "Konfirmasi password baru tidak cocok.";
    } else {
        // Hash password baru sebelum menyimpan ke database
        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

        // Update password di database
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";
        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Password berhasil diubah.";
        } else {
            $error_password = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Ubah Password</h1>
    </header>
    <div class="form-container">
        <form method="post" action="">
            <label for="password_lama">Password Lama:</label>
            <input type="password" id="password_lama" name="password_lama" required>
            <br>
            <label for="password_baru">Password Baru:</label>
            <input type="password" id="password_baru" name="password_baru" required>
            <br>
            <label for="konfirmasi_password">Konfirmasi Password Baru:</label>
            <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
            <br>
            <?php if (isset($error_password)) { ?>
                <p style="color: red;"><?php echo $error_password; ?></p>
            <?php } elseif (isset($success_message)) { ?>
                <p style="color: green;"><?php echo $success_message; ?></p>
            <?php } ?>
            <button type="submit">Ubah Password</button>
        </form>
        <a href="dashboard.php">Kembali ke Dasbor</a>
    </div>
    <footer>
        <p>&copy; 2024 Penjualan Kue. All Rights Reserved.</p>
    </footer>
</body>
</html>
