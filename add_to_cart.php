<?php
// Konfigurasi database
include "koneksi.php";

// Pastikan pengguna sudah login dan ada data yang diterima
if (isset($_SESSION['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $user_id = $_SESSION['user_id']; // Mendapatkan user_id dari session
    $product_id = $_POST['product_id']; // Mendapatkan product_id dari form
    $quantity = $_POST['quantity']; // Mendapatkan quantity dari form

    // Menyiapkan query untuk menambahkan produk ke keranjang
    $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";

    // Menyiapkan statement
    if ($stmt = $conn->prepare($query)) {
        // Mengikat parameter
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);

        // Menjalankan query
        if ($stmt->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare query.";
    }
} else {
    echo "Invalid request or user not logged in.";
}
?>
