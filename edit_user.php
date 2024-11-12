<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil data dari form
$user_id = $_POST['user_id'];
$level = $_POST['level'];

// Query untuk mengupdate role pengguna
$sql = "UPDATE users SET level='$level' WHERE user_id='$user_id'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    header("Location: dashboard user.php"); // Redirect kembali ke halaman users
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
