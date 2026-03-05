<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kontak</title>
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

      .navbar-brand img {
      height: 50px;
    }

      .text-shadow {
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
    }
  
    .carousel-wrapper {
      max-width: 1140px; 
      margin: 0 auto;     
      padding: 0 15px;
    }

    .carousel-container {
      border-radius: 15px;
      overflow: hidden;
      background-color: #000;
    }

    .carousel-inner img {
      width: 100%;
      height: auto;
      object-fit: cover;
      max-height: 420px; 
    }

    .card-body {
      border-top: 1px solid #dee2e6;
      padding-top: 1rem;
      margin-top: 1rem;
    }

    .card-img-top {
      max-height: 180px; 
      width: auto;       
      display: block;
      margin: 0 auto;    
      object-fit: contain;
    }

    .card-title {
      text-align: center;
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
            <li class="nav-item"><a class="nav-link active" href="dashboard.php">Beranda</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Produk</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profil.php">Laptop</a></li>
              <li><a class="dropdown-item" href="slider.php">Komputer</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link active fw-bold" href="kontak.php">Kontak</a></li>
          <li class="nav-item"><a class="nav-link active" href="hubungiKami.php">Hubungi Kami</a></li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-danger me-4" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Navbar end -->

  <!-- Info Perusahaan Section -->
  <section class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Tentang Kami</h2>
    <div id="profil-perusahaan" class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card shadow rounded-4 border-0">
          <div class="card-body">
            <p>Loading...</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Lokasi Google Maps -->
  <section class="py-5 bg-white">
    <div class="container">
      <h5 class="fw-bold mb-3 text-center">Lokasi Kami</h5>
      <div class="rounded-4 overflow-hidden shadow-sm" style="height: 300px;">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8946225287715!2d110.33933321533148!3d-7.80852859438548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57b8bc9b694f%3A0xa38e12bda73df3e1!2sUniversitas%20PGRI%20Yogyakarta!5e0!3m2!1sid!2sid!4v1682233565792!5m2!1sid!2sid" 
          width="100%" 
          height="300" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
<footer class="py-5 mb-0 bg-dark" style=" color: #f1f1f1;">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Menu -->
      <div class="col-6 col-md-3">
        <h6 class="fw-bold text-white">Menu</h6>
        <ul class="list-unstyled">
          <li><a href="dashboard.php" class="text-decoration-none text-light">Beranda</a></li>
          <li><a href="#" class="text-decoration-none text-light">Produk</a></li>
          <li><a href="kontak.php" class="text-decoration-none text-light fw-bold">Kontak</a></li>
          <li><a href="hubungiKami.php" class="text-decoration-none text-light">Hubungi Kami</a></li>
        </ul>
      </div>

      <!-- Produk -->
      <div class="col-6 col-md-3">
        <h6 class="fw-bold text-white">Produk</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-light">Laptop</a></li>
          <li><a href="#" class="text-decoration-none text-light">Komputer</a></li>
        </ul>
      </div>

      <!-- Asesoris -->
      <div class="col-6 col-md-3">
        <h6 class="fw-bold text-white">Asessoris</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-light">Mouse</a></li>
          <li><a href="#" class="text-decoration-none text-light">Speaker</a></li>
          <li><a href="#" class="text-decoration-none text-light">Keyboard</a></li>
        </ul>
      </div>

      <!-- Info Perusahaan -->
      <div class="col-12 col-md-3" id="footer-profil">
        <p>Memuat informasi perusahaan...</p>
      </div>
    </div>
  </div>

  <hr style="border-top: 1px solid #fff; opacity: 0.3;">

  <!-- Footer Bottom -->
  <div class="text-center text-light pt-4">
    <h5 class="mb-1">NAVEX</h5>
    <p class="mb-0">© NAVEX Indonesia</p>
  </div>
</footer>

  <!-- Script AJAX Profil Perusahaan (Main Content) -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch("../Admin/class/read_profil.php")
        .then(response => response.json())
        .then(data => {
          if (data.status === "success") {
            const profil = data.data;
            const html = `
              <h4 class="fw-bold mb-3 text-center">~${profil.nama_perusahaan}~</h4>
              <p><strong>Deskripsi:</strong> ${profil.deskripsi}</p>
              <p><strong>Alamat:</strong> ${profil.alamat}</p>
              <p><strong>Telepon:</strong> ${profil.telp}</p>
              <p><strong>Email:</strong> ${profil.email}</p>
            `;
            document.querySelector("#profil-perusahaan .card-body").innerHTML = html;
          } else {
            document.querySelector("#profil-perusahaan .card-body").innerHTML = "<p class='text-danger'>Gagal memuat profil perusahaan.</p>";
          }
        })
        .catch(error => {
          console.error(error);
          document.querySelector("#profil-perusahaan .card-body").innerHTML = "<p class='text-danger'>Terjadi kesalahan saat memuat data.</p>";
        });
    });
  </script>

  <!-- Script AJAX Profil Footer -->
  <script>
    fetch('../Admin/class/read_profilPerusahaan.php')
      .then(response => response.json())
      .then(result => {
        if (result.status === "success") {
          const data = result.data;
          const html = `
            <h6 class="fw-bold">${data.nama_perusahaan}</h6>
            <p class="mb-1"><strong>Deskripsi:</strong> ${data.deskripsi}</p>
            <p class="mb-1"><strong>Alamat:</strong> ${data.alamat}</p>
            <p class="mb-1"><strong>Telp:</strong> ${data.telp}</p>
            <p class="mb-3"><strong>Email:</strong> ${data.email}</p>

            <h6 class="fw-bold">Dapatkan Informasi Terbaru</h6>
            <p class="mb-2">Diskon besar-besaran setiap akhir bulan!</p>
            <form class="d-flex">
              <input type="email" class="form-control me-2" placeholder="Alamat e-mail">
              <button class="btn btn-danger" type="submit">Subscribe</button>
            </form>
          `;
          document.getElementById('footer-profil').innerHTML = html;
        } else {
          document.getElementById('footer-profil').innerHTML = "<p class='text-danger'>Data profil perusahaan tidak ditemukan.</p>";
        }
      })
      .catch(error => {
        console.error("Gagal memuat data profil perusahaan:", error);
        document.getElementById('footer-profil').innerHTML = "<p class='text-danger'>Gagal memuat informasi perusahaan.</p>";
      });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
