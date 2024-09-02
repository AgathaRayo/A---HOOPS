<?php
//memanggil file koneksi.php
include "koneksi.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$level = "user"; //level otomatis diisi user pd saat registrasi
$alamat= "alamat"; // Correctly retrieve the no_hp value

//format acak password harus sama dengan proses_login.php
$pengacak = "p3ng4c4k";
$password_acak = md5($pengacak.md5($password).$pengacak);

$kirim = isset($_POST['kirim']) ? $_POST['kirim'] : false;

//proses kirim data ke database MYSQL
if($kirim){
    $query = "INSERT INTO users (username, email, password, level, alamat) VALUES ('$username', '$email', '$password_acak', '$level', '$alamat')";
    $hasil = mysqli_query($conn, $query);

    if ($hasil) {
        header("Location: login.php");
    } else {
        echo "Registrasi User Gagal!";
    }
} else {
    echo "Registrasi User Gagal!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg\ ball.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="proses_register.php" method="post">
					<span class="login100-form-logo">
						<!-- Ganti ikon bulat hijau dengan logo -->
						<img src="images/logo-removebg-preview.png" alt="Logo" style="width: 200px; height: 200px;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Register
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					
					<div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="text" name="Email" placeholder="Email" required>
						<span class="focus-input100">
							<i class="fa fa-envelope "></i>
						</span>
					</div>
					
					
					

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password"required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<a href="/A-HOOPS/landingpage.html"><button class="login100-form-btn">
							Sign in
						</button></a>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="">
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
	<script src="js/main.js"></script>

</body>
</html>
