// cart.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Keranjang belanja kosong.</p>";
    echo '<a href="dashboard.php">Kembali ke Dashboard</a>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    include 'db.php';

    foreach ($_SESSION['cart'] as $item) {
        $nama_kue = $item['nama_kue'];
        $jumlah = $item['jumlah'];
        $harga = $item['harga'];
        $total_harga = $harga * $jumlah;

        $sql = "INSERT INTO transaksi (nama_kue, jumlah, harga, total_harga) VALUES ('$nama_kue', '$jumlah', '$harga', '$total_harga')";
        if ($conn->query($sql) === TRUE) {
            echo "Transaksi berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Clear the cart after checkout
    $_SESSION['transaksi'] = $_SESSION['cart'];
    unset($_SESSION['cart']);
    header("Location: print_transaksi.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Keranjang Belanja</h1>
    </header>
    <div class="cart-container">
        <form method="post" action="cart.php">
            <table>
                <tr>
                    <th>Nama Kue</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
                <?php
                $total_bayar = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total_harga = $item['harga'] * $item['jumlah'];
                    $total_bayar += $total_harga;
                    echo '<tr>';
                    echo '<td>' . $item['nama_kue'] . '</td>';
                    echo '<td>' . $item['jumlah'] . '</td>';
                    echo '<td>Rp ' . number_format($item['harga'], 2, ',', '.') . '</td>';
                    echo '<td>Rp ' . number_format($total_harga, 2, ',', '.') . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align:right;">Total Bayar:</td>
                    <td>Rp <?php echo number_format($total_bayar, 2, ',', '.'); ?></td>
                </tr>
            </table>
            <button type="submit" name="checkout">Checkout</button>
        </form>
        <a href="dashboard.php">Lanjutkan Belanja</a>
    </div>
</body>
</html>
