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
<body>
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
            <li class="nav-item"><a class="nav-link active fw-bold" href="dashboard.php">Beranda</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Produk</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profil.php">Laptop</a></li>
              <li><a class="dropdown-item" href="slider.php">Komputer</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link active" href="kontak.php">Kontak</a></li>
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

    <!-- Carousel Section -->
<div class="container my-5"> <!-- Ganti jadi container -->
  <div class="carousel-rgb-border">
    <div class="carousel-container">
      <div id="carouselExampleIndicators" class="carousel slide shadow rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators" id="carousel-indicators"></div>
        <div class="carousel-inner" id="carousel-inner"></div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="visually-hidden">Selanjutnya</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- End Carousel Section -->

  <!-- produk start -->
    <div class="container my-5">
    <h2 class="mb-4 text-center fw-semibold">Produk Kami</h2>
    <div class="row" id="produkContainer">
      <!-- Kartu produk dimuat di sini via AJAX -->
    </div>
    <div id="produkError" class="text-danger mt-2"></div>
  </div>
  <!-- produk end  -->

<!-- Footer Section -->
<footer class="py-5 mb-0 bg-dark" style=" color: #f1f1f1;">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Menu -->
      <div class="col-6 col-md-3">
        <h6 class="fw-bold text-white">Menu</h6>
        <ul class="list-unstyled">
          <li><a href="dashboard.php" class="text-decoration-none text-light fw-bold">Beranda</a></li>
          <li><a href="#" class="text-decoration-none text-light">Produk</a></li>
          <li><a href="kontak.php" class="text-decoration-none text-light">Kontak</a></li>
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

  <!-- AJAX Untuk Slider/Carousel -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch('../Admin/class/getSlider.php')  // pastikan path sesuai
      .then(response => response.json())
      .then(data => {
        const indicators = document.getElementById("carousel-indicators");
        const inner = document.getElementById("carousel-inner");

        indicators.innerHTML = "";
        inner.innerHTML = "";

        data.forEach((item, index) => {
          // Buat tombol indikator
          const button = document.createElement("button");
          button.type = "button";
          button.setAttribute("data-bs-target", "#carouselExampleIndicators");
          button.setAttribute("data-bs-slide-to", index);
          button.setAttribute("aria-label", `Slide ${index + 1}`);
          if (index === 0) {
            button.classList.add("active");
            button.setAttribute("aria-current", "true");
          }
          indicators.appendChild(button);

          // Buat item carousel
          const carouselItem = document.createElement("div");
          carouselItem.className = "carousel-item" + (index === 0 ? " active" : "");
          carouselItem.innerHTML = `
            <img src="../Admin/${item.gambar_slider}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="${item.judul_slider}">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center bottom-0 mb-4">
              <h5 class="fw-bold text-white text-shadow">${item.judul_slider}</h5>
              <p class="text-white text-shadow">${item.sub_judul_slider}</p>
            </div>
          `;
          inner.appendChild(carouselItem);
        });
      })
      .catch(error => {
        console.error("Error fetching slider:", error);
      });
  });
  </script>

  <!-- AJAX Untuk Produk -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch("../Admin/class/read_produk.php")
        .then(response => response.json())
        .then(data => {
          const produk = data.data || data;
          const container = document.getElementById("produkContainer");
          container.innerHTML = "";

          if (produk.length === 0) {
            container.innerHTML = "<p class='text-muted'>Tidak ada produk tersedia.</p>";
            return;
          }

          produk.forEach(item => {
            const col = document.createElement("div");
            col.className = "col-md-4 mb-4";

            col.innerHTML = `
              <div class="card h-100 shadow-sm">
                <img src="../Admin/${item.gambar}" class="card-img-top" alt="${item.judul_home}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                  <h5 class="card-title">${item.judul_home}</h5>
                  <p class="card-text">${item.deskripsi_judul}</p>
                </div>
              </div>
            `;

            container.appendChild(col);
          });
        })
        .catch(error => {
          console.error("Gagal memuat produk:", error);
          document.getElementById("produkContainer").innerHTML = "<p class='text-danger'>Gagal memuat produk.</p>";
        });
    });
  </script>

  <!-- AJAX Untuk Profil Perusahaan di Footer -->
  <script>
    fetch('../Admin/class/read_profilPerusahaan.php')
      .then(response => response.json())
      .then(result => {
        if (result.status === "success") {
          const data = result.data;
          const html = `
            <h6 class="fw-bold">${data.nama_perusahaan}</h6>
            <p class="mb-1"><strong>Deskripsi:</strong>${data.deskripsi}</p>
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
