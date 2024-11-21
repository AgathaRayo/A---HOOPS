<?php
session_start();
include 'koneksi.php'; // File koneksi ke database

// Asumsikan bahwa ID user disimpan dalam sesi login
$user_id = $_SESSION['user_id'];

// Query untuk mengambil data user dari database
$query = "SELECT name, email, phone, address FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Contoh setelah verifikasi login berhasil
$_SESSION['user_id'] = $user_id; // Diambil dari hasil query login
header("Location: profile.php");
exit;

if ($user) {
    // Tampilkan informasi user di halaman profil
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $address = $user['address'];
} else {
    echo "User not found!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/logo.png">
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        .profile-header {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
            position: relative;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #343a40;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #d6d8db;
            border-color: #d6d8db;
            color: #343a40;
        }
        .profile-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        .edit-btn {
            margin-top: 20px;
            text-align: right;
        }
        .order-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .order-card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .order-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-status {
            font-weight: bold;
            text-transform: uppercase;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Profile Header -->
    <div class="profile-header">
        <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-picture">
        <h2 class="mt-3"><?php echo htmlspecialchars($name); ?></h2>
        <p class="text-muted"><?php echo htmlspecialchars($email); ?></p>
        <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>

    <!-- Profile Information -->
    <div class="profile-info">
        <h4>Profile Information</h4>
        <table class="table">
            <tr>
                <th>Name:</th>
                <td><?php echo htmlspecialchars($name); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td><?php echo htmlspecialchars($phone); ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo htmlspecialchars($address); ?></td>
            </tr>
        </table>
        <div class="edit-btn">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
              Edit Profile
            </button>
        </div>
    </div>

    <!-- My Orders Section -->
    <div class="order-section">
        <h4>My Orders</h4>
        <div class="order-card card">
            <div class="card-body">
                <div>
                    <h5>Order #12345</h5>
                    <p class="mb-1">Order Date: 2024-09-01</p>
                    <p class="mb-0">Total: $150.00</p>
                </div>
                <div>
                    <span class="order-status">Completed</span>
                </div>
            </div>
        </div>
        <div class="order-card card">
            <div class="card-body">
                <div>
                    <h5>Order #12344</h5>
                    <p class="mb-1">Order Date: 2024-08-20</p>
                    <p class="mb-0">Total: $75.00</p>
                </div>
                <div>
                    <span class="order-status text-warning">Pending</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" value="<?php echo htmlspecialchars($name); ?>">
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" value="<?php echo htmlspecialchars($email); ?>">
          </div>
          <div class="mb-3">
            <label for="editPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="editPhone" value="<?php echo htmlspecialchars($phone); ?>">
          </div>
          <div class="mb-3">
            <label for="editAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="editAddress" value="<?php echo htmlspecialchars($address); ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
