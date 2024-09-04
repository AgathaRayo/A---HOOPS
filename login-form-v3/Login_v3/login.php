<?php
// Memulai session untuk login user
session_start();

// Memanggil file koneksi ke database
include "koneksi.php";

// Pastikan form sudah mengirim data
if (isset($_POST['logmail']) && isset($_POST['logpass'])) {
    $email = mysqli_real_escape_string($conn, $_POST['logmail']);
    $password = mysqli_real_escape_string($conn, $_POST['logpass']);

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
            // Alihkan ke halaman dashboard user
            header("Location: ../../index.html");
            exit();
        } else {
            echo "Anda Bukan Admin dan Bukan User";
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
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100";>
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-logo">
						<!-- Ganti ikon bulat hijau dengan logo -->
						<img src="images/logo-removebg-preview.png" alt="Logo" style="width: 200px; height: 200px;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="email" name="logmail" placeholder="Email" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="logpass" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="register.php">
							Don't have an account yet? Register
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<
