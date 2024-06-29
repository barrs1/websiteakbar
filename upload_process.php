<?php
// Pastikan Anda memiliki koneksi ke database
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kue = $_POST['nama_kue'];
    $harga = $_POST['harga'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $gambar_temp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "uploads/" . $gambar; // Sesuaikan path penyimpanan gambar di server

    if (move_uploaded_file($gambar_temp, $gambar_path)) {
        // Simpan data ke database
        $sql = "INSERT INTO kue (nama_kue, harga, gambar) VALUES ('$nama_kue', $harga, '$gambar_path')";
        if ($conn->query($sql) === TRUE) {
            echo "Data kue berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal mengunggah gambar.";
    }
}
?>
