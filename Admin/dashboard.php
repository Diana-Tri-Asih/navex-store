<?php
include "include/checkLogin.php";
include "class/dbh.php";

$sql = "SELECT * FROM produk ORDER BY id_home ASC";
$query = mysqli_query($connection, $sql);

$produk = [];
while ($row = mysqli_fetch_assoc($query)) {
  if ($row['status'] === 'aktif') {
    $produk[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Halaman Utama</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
      body {
        background-color: #f8f9fa;
        overflow-x: hidden;
      }

      .navbar {
        background-color: #f8f9fa !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .navbar form button {
        margin-top: 0 !important;
        padding: 6px 12px !important;
        height: 38px !important;
        line-height: 1.2;
        font-size: 0.9rem;
      }

      .navbar-brand,
      .nav-link {
        color: #212529 !important;
        font-weight: 500;
      }

      .truncated-text {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .product-card {
        transition: transform 0.3s;
      }
      .product-card:hover {
        transform: scale(1.03);
      }

      .product-card img {
        max-height: 180px; 
        width: auto;       
        display: block;
        margin: 0 auto;    
        object-fit: contain; 
      }
      
      .container h4 {
        font-weight: 600;
      }
    </style>
</head>
<body class="bg-light">

  <!-- Navbar -->
    <nav class="navbar navbar-light navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="img/logo.jpeg" style="height: 55px; width: 100px; margin-left: 15px" alt="NAVEX" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="home.html">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">Master</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profil.php">Edit Profil</a></li>
              <li><a class="dropdown-item" href="slider.php">Slider</a></li>
              <li><a class="dropdown-item" href="daftar_produk.php">Daftar Produk</a></li>
              <li><a class="dropdown-item fw-bold" href="dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="profilPerusahaan.php">Profil Perusahaan</a></li>
              <li><a class="dropdown-item" href="hubungiKami.php">Hubungi Kami</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-danger me-4" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Navbar end -->

  <!-- Welcome -->
    <div class="container text-center mt-5">
      <hr />
      <h4>Selamat datang <strong>"<?php echo $_SESSION ['username'] ?>"</strong> di Halaman utama</h4>
      <form action="class/logout.php" method="post">
        <button type="submit" class="btn btn-danger">Keluar Halaman</button>
      </form>
    </div>

      <!-- Footer -->
      <footer class="footer bg-dark text-dark text-center py-3 shadow-sm" style="position: fixed; bottom: 0; width: 100%; z-index: 1030;">
        <div class="container">
          <h5 class="card-title text-center text-white">NAVEX</h5>
          <p class="card-text text-center text-light">© NAVEX Indonesia</p>
        </div>
      </footer>
    <!-- Footer End -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>