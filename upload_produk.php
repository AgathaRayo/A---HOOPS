<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'basketball_shop';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Cek jika form telah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['Nama_Produk'];
    $category = $_POST['Kategori'];
    $price = $_POST['Harga'];
    $stock = $_POST['Stok'];
    $description = $_POST['Deskripsi'];

    // Upload gambar jika ada
    if (isset($_FILES['Gambar']) && $_FILES['Gambar']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['Gambar']['name']);
        $imagePath = 'uploads/' . $imageName;
        move_uploaded_file($_FILES['Gambar']['tmp_name'], $imagePath);
    } else {
        $imagePath = null;
    }

    // Masukkan data produk ke database
    $sql = "INSERT INTO products (Nama_Produk, Kategori, Harga, Stok, Gambar, Deskripsi) 
            VALUES (:Nama_Produk, :Kategori, :Harga, :Stok, :Gambar, :Deskripsi)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':Nama_Produk' => $productName,
        ':Kategori' => $category,
        ':Harga' => $price,
        ':Stok' => $stock,
        ':Gambar' => $imagePath,
        ':Deskripsi' => $description,
    ]);

    echo "Produk berhasil ditambahkan!";
}
?>
