<?php
session_start();
require_once 'config.php'; // Include file config.php yang berisi koneksi database

// Inisialisasi variabel
$errors = [];
$firstName = $lastName = $companyName = $address = $city = $country = $postcode = $mobile = $email = "";
$totalAmount = 0;

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi data form
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $companyName = trim($_POST['company_name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $postcode = trim($_POST['postcode']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $orderNotes = trim($_POST['order_notes']);

    // Validasi input (contoh sederhana)
    if (empty($firstName)) {
        $errors[] = "First Name is required";
    }
    if (empty($lastName)) {
        $errors[] = "Last Name is required";
    }
    if (empty($address)) {
        $errors[] = "Address is required";
    }
    if (empty($city)) {
        $errors[] = "City is required";
    }
    if (empty($country)) {
        $errors[] = "Country is required";
    }
    if (empty($postcode)) {
        $errors[] = "Postcode is required";
    }
    if (empty($mobile)) {
        $errors[] = "Mobile is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid Email is required";
    }

    // Jika tidak ada error, proses order
    if (empty($errors)) {
        // Contoh proses order
        $orderQuery = "INSERT INTO orders (first_name, last_name, company_name, address, city, country, postcode, mobile, email, order_notes, total_amount) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($orderQuery);
        $stmt->bind_param("sssssssssss", $firstName, $lastName, $companyName, $address, $city, $country, $postcode, $mobile, $email, $orderNotes, $totalAmount);

        if ($stmt->execute()) {
            // Simpan detail produk ke tabel order_items (Anda perlu membuat tabel ini di database)
            $orderId = $stmt->insert_id;

            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $productQuery = "SELECT * FROM products WHERE id = ?";
                $stmt = $conn->prepare($productQuery);
                $stmt->bind_param("i", $productId);
                $stmt->execute();
                $productResult = $stmt->get_result();
                $product = $productResult->fetch_assoc();

                $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                              VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($itemQuery);
                $stmt->bind_param("iiid", $orderId, $productId, $quantity, $product['price']);
                $stmt->execute();
            }

            // Setelah order berhasil, kosongkan cart
            unset($_SESSION['cart']);

            // Redirect ke halaman terima kasih atau konfirmasi order
            header("Location: thank_you.php");
            exit();
        } else {
            $errors[] = "Failed to place order. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- HTML halaman checkout tetap sama, hanya tambahkan bagian PHP untuk menampilkan pesan error dan pengolahan data form -->

<body>
    <!-- Tampilkan pesan error jika ada -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Form checkout tetap sama -->
    <form action="checkout.php" method="POST">
        <!-- Input form disesuaikan dengan PHP -->
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
        <!-- Tambahkan input form lainnya -->
        
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</body>
</html>
