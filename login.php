<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Penjualan Kue</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 50px; /* Add padding to push content up */
        }
        .login-container {
            width: 300px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 32px;
            color: #333;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
            font-size: 14px;
        }
        .login-container input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            width: calc(100% - 22px);
            padding: 12px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-container button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Toko Kue Akbar</h1>
        <h2>Login</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
