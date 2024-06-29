<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $nama_kue = $_POST['nama_kue'];
    $harga = $_POST['harga'];
    $tanggal = date('Y-m-d');

    $sql = "INSERT INTO transaksi (username, nama_kue, harga, tanggal) VALUES ('$username', '$nama_kue', '$harga', '$tanggal')";

    if ($conn->query($sql) === TRUE) {
        echo "Pembelian berhasil!";
        header("refresh:2;url=dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
