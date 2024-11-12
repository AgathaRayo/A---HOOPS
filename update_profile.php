<?php
// Koneksi ke database
include 'koneksi.php';

// Mulai sesi untuk mengakses user_id
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Periksa apakah data form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validasi sederhana (opsional)
    if (empty($username) || empty($email)) {
        echo "Username dan email tidak boleh kosong.";
        exit();
    }

    // Update data pengguna di database tanpa kolom phone dan address
    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman profile dengan pesan sukses
        header("Location: profile.php?update=success");
        exit();
    } else {
        echo "Gagal memperbarui profil: " . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
