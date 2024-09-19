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
