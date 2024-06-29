<?php
session_start();
if (!isset($_SESSION['transaksi'])) {
    header("Location: dashboard.php");
    exit();
}

// Set zona waktu Indonesia
date_default_timezone_set('Asia/Jakarta');

// Ambil data transaksi dari session
$transaksi = $_SESSION['transaksi'];

// Hapus data transaksi dari session setelah dicetak
unset($_SESSION['transaksi']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        .btn-back {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Transaksi</h2>
        <p><strong>Nama Kue:</strong> <?php echo $transaksi['nama_kue']; ?></p>
        <p><strong>Harga:</strong> Rp <?php echo number_format($transaksi['harga'], 2, ',', '.'); ?></p>
        <p><strong>Tanggal Transaksi:</strong> <?php echo date('d-m-Y H:i:s'); ?></p>
        <p>Terima kasih telah berbelanja di toko cake akbar</p>

        <!-- Tautan kembali ke halaman dashboard -->
        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>
