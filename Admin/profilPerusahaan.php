<?php
include "include/checkLogin.php";
include "class/dbh.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil Perusahaan</title>
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
      .container h4 {
        font-weight: 600;
      }

   
        h2 {
            padding-top: 2rem;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        textarea {
            min-height: 100px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
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
            <li class="nav-item">
              <a class="nav-link" href="home.html">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">Master</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profil.php">Edit Profil</a></li>
                <li><a class="dropdown-item" href="slider.php">Slider</a></li>
                <li><a class="dropdown-item" href="daftar_produk.php">Daftar Produk</a></li>
                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                <li><a class="dropdown-item fw-bold" href="profilPerusahaan.php">Profil Perusahaan</a></li>
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

  <div class="container">
    <h2 class="text-black fw-bold">Form Profil Perusahaan</h2>
    <form id="formProfil" action="class/updatePerusahaan.php" method="POST">
        <label for="nama">Nama Perusahaan</label>
        <input type="text" id="nama" name="nama" required>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" required></textarea>

        <label for="telepon">Telephone</label>
        <input type="text" id="telepon" name="telepon" required pattern="[0-9]+" title="Hanya angka yang diperbolehkan">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <button type="submit" name="update_perusahaan" value="update_perusahaan">Update</button>
    </form>
</div>

      <!-- Footer -->
        <footer class="footer bg-dark text-dark text-center py-3 shadow-sm mt-5" style="position: static; width: 100%; z-index: 1030;">
          <div class="container">
            <h5 class="card-title text-center text-white">NAVEX</h5>
            <p class="card-text text-center text-light">© NAVEX Indonesia</p>
          </div>
        </footer>
      <!-- Footer End -->

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  document.getElementById("formProfil").addEventListener("submit", function(event) {
    event.preventDefault(); // Mencegah form terkirim langsung

    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data Profil Perusahaan Akan Diperbarui.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, update!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit(); // Kirim form secara manual jika dikonfirmasi
      }
    });
  });

  function loadProdukData() {
    fetch('class/getPerusahaan.php')
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);
            const nama = document.querySelector ("#nama");
            const deskripsi = document.querySelector ("#deskripsi");
            const alamat = document.querySelector ("#alamat");
            const telepon = document.querySelector ("#telepon");
            const email = document.querySelector ("#email");

            data.forEach((item, index) => {
              nama.value = item.nama_perusahaan;
              deskripsi.value = item.deskripsi;
              alamat.value = item.alamat;
              telepon.value = item.telp;
              email.value = item.email;
            });
        })
        .catch(error => {
            console.error('Gagal memuat data produk:', error);
        });
  }

  // Edit Perusahaan
  document.getElementById('formProfil').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    fetch('class/updatePerusahaan.php', {
        method: 'POST',
        body: formData,
    })
    .then(res => res.json()) // Ubah dari text() ke json()
    .then(response => {
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Di Edit!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                form.reset();
                loadProdukData();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menambahkan!',
                text: response.message || 'Terjadi kesalahan.'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan jaringan atau server.'
        });
    });
  });

  document.addEventListener("DOMContentLoaded", () => {
    loadProdukData();
  });
</script>

</body>
</html>
