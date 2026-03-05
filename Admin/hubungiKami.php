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
<html lang="id">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pesan Konsumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.css" rel="stylesheet" integrity="sha384-euvbLDizNhjdB+SK/Ai+GY3WCCHaDJM1tnnh2IqvUY9zjhlo21JkywSg8X5hlMY8" crossorigin="anonymous">
 
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
        table td, table th {
            text-align: center;
            vertical-align: middle;
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
                <li><a class="dropdown-item" href="profilPerusahaan.php">Profil Perusahaan</a></li>
                <li><a class="dropdown-item fw-bold" href="hubungiKami.php">Hubungi Kami</a></li>
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

<div class="container mt-5">
    <div class="d-flex justify-content-beetween align-items-center mb-3">
        <h2 class="text-black fw-bold">Pesan Konsumen</h2>
    </div>

    <div class="table-responsive">
        <table id="dataBlog" class="table table-hover table-bordered align-middle shadow-sm bg-white rounded">
            <thead class="table-success text-center">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nama Pengirim</th>
                    <th style="width: 30%;">No Telepon</th>
                    <th style="width: 15%;">Email</th>
                    <th style="width: 20%;">Isi Pesan</th>
                    <th style="width: 15%;">Tindakan</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <!-- Data akan dimuat via JavaScript -->
            </tbody>
        </table>
    </div>
</div>

    <!-- Footer -->
      <footer class="footer bg-dark text-dark text-center py-3 shadow-sm" style="position: fixed; bottom: 0; width: 100%; z-index: 1030;">
        <div class="container">
          <h5 class="card-title text-center text-white">NAVEX</h5>
          <p class="card-text text-center text-light">© NAVEX Indonesia</p>
        </div>
      </footer>
    <!-- Footer End -->

    <!-- JS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.3.1/datatables.min.js" integrity="sha384-1LmfH5u7+DRwux/q4YYqAi+OjwkIVYJdPQijPS9S28cj8AeFnpNCkSVlZgvRdOzb" crossorigin="anonymous"></script>


<script>
document.addEventListener("DOMContentLoaded", function () {
  fetch("class/read_pesan.php")
    .then(response => response.json())
    .then(result => {
      if (result.status === "success") {
        const data = result.data;
        const tbody = document.querySelector("#dataBlog tbody");
        tbody.innerHTML = "";

        data.forEach((pesan, index) => {
          const row = `
            <tr>
                <td class="text-center">${index + 1}</td>
                <td class="text-center">${pesan.nama_pengirim}</td>
                <td class="text-center">${pesan.no_tlp_pengirim}</td>
                <td class="text-center">${pesan.email_pengirim}</td>
                <td class="text-center">${pesan.isi_pesan}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm" onclick="BalasPesan(${pesan.id_hub})">Balas</button>
                    <button class="btn btn-danger btn-sm" onclick="hapusPesan(${pesan.id_hub})">Hapus</button>
                </td>
            </tr>

          `;
          tbody.insertAdjacentHTML("beforeend", row);
        });

        // Aktifkan DataTables setelah data dimuat
        new DataTable("#dataBlog");
      } else {
        alert("Gagal memuat data: " + result.message);
      }
    })
    .catch(error => {
      console.error("Error:", error);
      alert("Terjadi kesalahan saat memuat pesan.");
    });
});

// Contoh fungsi hapus
function hapusPesan(id) {
  if (confirm("Yakin ingin menghapus pesan ini?")) {
    // Logika fetch ke hapus_pesan.php 
    alert("Hapus pesan dengan ID: " + id);
  }
}

document.getElementById('btnLogout').addEventListener('click', function(e) {
    Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Anda akan keluar dari sesi admin.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
        }
    });
});

function hapusPesan(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`class/delete_pesan.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success') {
                    Swal.fire('Berhasil!', result.message, 'success').then(() => {
                        location.reload(); // refresh halaman agar tabel terupdate
                    });
                } else {
                    Swal.fire('Gagal', result.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
        }
    });
}

function BalasPesan(id) {
    Swal.fire({
        title: 'Balas Pesan Konsumen',
        input: 'textarea',
        inputLabel: 'Isi Balasan',
        inputPlaceholder: 'Tulis balasan di sini...',
        inputAttributes: {
            'aria-label': 'Tulis balasan di sini'
        },
        showCancelButton: true,
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Batal',
        preConfirm: (isi_balasan) => {
            if (!isi_balasan) {
                Swal.showValidationMessage('Balasan tidak boleh kosong!');
            }
            return isi_balasan;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('class/balas_pesan.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    balasan: result.value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Terkirim!', data.message, 'success');
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim balasan.', 'error');
            });
        }
    });
}
</script>

</body>
</html>