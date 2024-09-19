<?php
// Memanggil file koneksi ke database
include "koneksi.php";

// Menangkap data yang dikirim dari form register.php
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Format acak password
    $pengacak = "p3ng4c4k";
    $password_acak = md5($pengacak . md5($password) . $pengacak);

    // Menyimpan data ke database
    $query = "INSERT INTO users (username, email, password, level) VALUES ('$username', '$email', '$password_acak', 'user')";
    if (mysqli_query($conn, $query)) {
        echo "Registrasi User Berhasil!";
    } else {
        echo "Registrasi User Gagal!";
    }
} else {
    echo "Form tidak lengkap!";
}
?>



