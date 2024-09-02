<?php
// Memulai session untuk login user
session_start();

// Memanggil file koneksi ke database
include "koneksi.php";

// Menangkap data yang dikirim dari form login.php
$email = $_POST['logmail'];
$password = $_POST['logpass'];

// Format acak password harus sama dengan proses_register.php
$pengacak = "p3ng4c4k";
$password_acak = md5($pengacak . md5($password) . $pengacak);

// Menyeleksi data user dengan username dan password acak yang sesuai
$query = "SELECT * FROM tb_user WHERE email='$email' AND password='$password_acak'";

// Menjalankan query dan menampung hasil dalam variabel $hasil
$hasil = mysqli_query($conn, $query);

// Menangkap data dari hasil perintah query SQL
$data = mysqli_fetch_array($hasil);

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($hasil);

// Cek apakah username dan password ditemukan pada database
if ($cek > 0) {
    // Cek jika user login sebagai admin
    if ($data['level'] == "admin") {
        // Buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        // Alihkan ke halaman dashboard admin
        header("Location: hal_admin.php");
    }
    // Cek jika user login sebagai user
    else if ($data['level'] == "user") {
        // Buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "user";
        // Alihkan ke halaman dashboard user
        header("Location: index.html");
    }
    else {
        echo "Anda Bukan Admin dan Bukan User";
        // Alihkan ke halaman login kembali (Opsional)
        // header("Location: login.php");
    }
}
else {
    // Jika username dan password tidak ditemukan pada database
    echo "GAGAL LOGIN!!!, Username dan Password tidak ditemukan";
}
?>
proses login