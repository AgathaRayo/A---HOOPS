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