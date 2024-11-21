<?php
include 'koneksi.php'; // Koneksi ke database

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query untuk menghapus user
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: dashboard_user.php");
        exit;
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "Invalid ID!";
}

mysqli_close($conn);
?>
