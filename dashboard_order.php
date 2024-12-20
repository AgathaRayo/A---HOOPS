<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Admin Dashboard</title>
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

        .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }

        .nav-link.active {
            color: #007bff;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .card-header {
            font-weight: bold;
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
                            <a class="nav-link active" href="dashboard_order.php">
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
                            <a class="nav-link" href="dashboard_user.php">
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
                    <h1 class="h2">Orders</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Search orders">
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card mb-4">
                    <div class="card-header">Filter Orders</div>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label for="orderStatus" class="form-label">Status</label>
                                <select class="form-select" id="orderStatus">
                                    <option selected>Choose...</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Completed</option>
                                    <option value="3">Canceled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="orderDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="orderDate">
                            </div>
                            <div class="col-md-4 align-self-end">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#1001</td>
                                <td>John Doe</td>
                                <td>2023-08-19</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>$100.00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>#1002</td>
                                <td>Jane Smith</td>
                                <td>2023-08-18</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>$200.00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>#1003</td>
                                <td>Michael Johnson</td>
                                <td>2023-08-17</td>
                                <td><span class="badge bg-danger">Canceled</span></td>
                                <td>$150.00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">View</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
</body>
</html>
