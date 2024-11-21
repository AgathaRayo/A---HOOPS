<?php
// Hubungkan dengan file koneksi database
include 'koneksi.php';

// Cek apakah ada ID yang dikirim untuk dihapus
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM contact WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesan berhasil dihapus'); window.location.href='dashboard_contact.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Tutup koneksi database
$conn->close();
?>
