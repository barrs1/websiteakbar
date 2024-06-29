<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title> CAKE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>TOKO CAKE AKBAR</h1>   
    </header>
    <div class="dashboard-container">
        <h2>PILIHAN CAKE <?php echo $_SESSION['username']; ?></h2>
        <nav>
            <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="kue-container">
            <?php
            $sql = "SELECT * FROM kue";


            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="kue-item">';
                    echo '<img src="' . $row["gambar"] . '" alt="' . $row["nama_kue"] . '" class="kue-img">';
                    echo '<h4>' . $row["nama_kue"] . '</h4>';
                    echo '<p>Harga: Rp ' . number_format($row["harga"], 2, ',', '.') . '</p>';
                    echo '<a href="transaksi.php?id=' . $row["id"] . '" class="btn-beli">Beli Sekarang</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada data kue.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
