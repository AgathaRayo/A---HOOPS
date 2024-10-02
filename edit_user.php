<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    // Update data user di database
    $sql = "UPDATE users SET username='$username', email='$email', level='$level' WHERE user_id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully";
        header('Location: dashboard customer.php');
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
