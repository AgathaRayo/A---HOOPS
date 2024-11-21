<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
   
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
        body {
            font-size: .875rem;
        }
        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
        }
        .nav-link {
            font-weight: 500;
            color: #333;
        }
        .nav-link.active {
            color: #007bff;
        }
        .card {
            margin-bottom: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table-actions {
            display: flex;
            gap: 10px;
        }
        .table-actions .btn {
            padding: 2px 8px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_order.php">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_produk.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="dashboard_user.php">
                                <span data-feather="users"></span>
                                User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_contact.php">
                                <span data-feather="mail"></span>
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Users</h1>
                </div>

                <!-- Customers Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Koneksi ke database
                            include 'koneksi.php';

                            // Query untuk mengambil data pengguna
                            $sql = "SELECT user_id, username, email, password, level FROM users";
                            $result = mysqli_query($conn, $sql);

                            // Menampilkan data ke tabel
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['level']) . "</td>";
                                    echo "<td>
                                    <div class='table-actions'>
                                        <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editUserModal' 
                                        data-id='" . $row['user_id'] . "' 
                                        data-username='" . $row['username'] . "' 
                                        data-email='" . $row['email'] . "' 
                                        data-level='" . $row['level'] . "'>Edit</button>
                                        <a href='delete_user.php?id=" . $row['user_id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </div>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }
                            // Tutup koneksi
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" action="edit_user.php">
                        <input type="hidden" name="user_id" id="user_id">
                        
                        <div class="mb-3">
                            <label for="level" class="form-label">Role</label>
                            <select class="form-control" id="level" name="level">
                                <option value="admin">Admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();

        // Isi modal dengan data user yang akan diedit
        const editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const email = button.getAttribute('data-email');
            const level = button.getAttribute('data-level');

            const modalBodyInputId = editUserModal.querySelector('#user_id');
            const modalBodyInputUsername = editUserModal.querySelector('#username');
            const modalBodyInputEmail = editUserModal.querySelector('#email');
            const modalBodySelectLevel = editUserModal.querySelector('#level');

            modalBodyInputId.value = userId;
            modalBodyInputUsername.value = username;
            modalBodyInputEmail.value = email;
            modalBodySelectLevel.value = level;
        });
    </script>
</body>
</html>
