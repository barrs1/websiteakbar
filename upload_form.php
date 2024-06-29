<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Upload Gambar cake</title>
</head>
<body>
    <h2>Form Upload Gambar cake</h2>
    <form action="upload_process.php" method="post" enctype="multipart/form-data">
        <label for="nama_kue">Nama cake:</label><br>
        <input type="text" id="nama_kue" name="nama_kue" required><br><br>
        
        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" required><br><br>
        
        <label for="gambar">Gambar cake:</label><br>
        <input type="file" id="gambar" name="gambar" accept="image/kuee1" required><br><br>
        
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>
