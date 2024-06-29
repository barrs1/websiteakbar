<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Ambil ID kue dari parameter GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_kue = $_GET['id'];

    // Query untuk mendapatkan detail kue berdasarkan ID
    $sql = "SELECT * FROM kue WHERE id = $id_kue";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Kue tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter ID kue tidak valid.";
    exit();
}

// Simpan data transaksi ke dalam session atau database sesuai kebutuhan
// Misalnya, di sini bisa menggunakan session untuk menyimpan informasi transaksi sementara
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Contoh penyimpanan sederhana ke dalam session
    $_SESSION['transaksi'] = [
        'id_kue' => $row['id'],
        'nama_kue' => $row['nama_kue'],
        'harga' => $row['harga'],
        'gambar' => $row['gambar'],
        'tanggal' => date('Y-m-d H:i:s')
    ];

    // Redirect atau lakukan operasi sesuai kebutuhan setelah transaksi disimpan
    header("Location: cetak_transaksi.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Penjualan CAKE</h1>
    </header>
    <div class="dashboard-container">
        <h2>Detail Transaksi</h2>
        <div class="kue-container">
            <div class="kue-item">
                <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_kue']; ?>">
                <h4><?php echo $row["nama_kue"]; ?></h4>
                <p>Harga: Rp <?php echo number_format($row["harga"], 2, ',', '.'); ?></p>
                <form method="post">
                    <button type="submit">Beli Sekarang</button>
                </form>
            </div>
        </div>
        <a href="dashboard.php">Kembali ke Dasbor</a>
    </div>
    
</body>
</html>
