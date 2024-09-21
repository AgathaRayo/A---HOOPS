<?php
// Memulai session untuk login user
session_start();

// Memanggil file koneksi ke database
include "koneksi.php";

// Pastikan form sudah mengirim data
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Format acak password harus sama dengan proses_register.php
    $pengacak = "p3ng4c4k";
    $password_acak = md5($pengacak . md5($password) . $pengacak);

    // Menyeleksi data user dengan email dan password acak yang sesuai
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password_acak'";

    // Menjalankan query dan menampung hasil dalam variabel $hasil
    $hasil = mysqli_query($conn, $query);

    // Menangkap data dari hasil perintah query SQL
    $data = mysqli_fetch_array($hasil);

    // Menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($hasil);

    // Cek apakah email dan password ditemukan pada database
    if ($cek > 0) {
        // Cek jika user login sebagai admin
        if ($data['level'] == "admin") {
            // Buat session login dan email
            $_SESSION['email'] = $data['email'];
            $_SESSION['level'] = "admin";
            // Alihkan ke halaman dashboard admin
            header("Location: hal_admin.php");
            exit();
        }
        // Cek jika user login sebagai user
        else if ($data['level'] == "user") {
            // Buat session login dan email
            $_SESSION['email'] = $data['email'];
            $_SESSION['level'] = "user";
            // Alihkan ke halaman utama (index.html)
            header("Location: index.html");
            exit();
        } else {
            echo "Anda bukan Admin dan bukan User.";
        }
    } else {
        // Jika email dan password tidak ditemukan pada database
        echo "GAGAL LOGIN!!!, Email dan Password tidak ditemukan";
    }
} else {
    echo "Form tidak lengkap!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            max-width: 500px; /* Menambah lebar maksimum */
            width: 100%;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
        .form-header {
            margin-bottom: 20px;
        }
        .form-header h2 {
            margin-bottom: 10px;
        }
        .logo-container {
            width: 100px; /* Ukuran logo */
            height: 100px; /* Ukuran logo */
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f8f9fa; /* Warna latar belakang logo */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Tempat untuk Logo -->
        <div class="logo-container">
            <img src="img/logo.png" alt="Logo">
        </div>
        <div class="form-header">
            <h2>Login</h2>
        </div>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="mt-3 text-center">Don't have an account? <a href="registerform.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
