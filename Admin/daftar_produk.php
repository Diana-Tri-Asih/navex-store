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
    <title>Daftar Produk</title>
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

        .navbar-brand,
        .nav-link {
            color: #212529 !important;
            font-weight: 500;
        }

        .foto-profil {
            width: 400px;
            height: 200px;
        }

        .btn-logout {
            background-color: #dc3545; 
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .btn-logout i {
            font-size: 1rem;
        }

        .welcome-section {
            margin-top: 50px;
            margin-bottom: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        .card-custom {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            padding: 20px;
            transition: transform 0.3s;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-8px);
        }

        .card-custom img {
            width: 80px;
            height: auto;
            margin-bottom: 20px;
        }

        .text-limiter {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .footer {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light navbar-expand-lg">
      <div class="container-fluid">
    <!-- Brand Logo -->
    <a class="navbar-brand" href="#">
          <img src="img/logo.jpeg" style="height: 55px; width: 100px; margin-left: 15px" alt="NAVEX" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

    <!-- Dropdown Menu -->
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="home.html">Beranda</a>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Master
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="profil.php">Edit Profil</a></li>
          <li><a class="dropdown-item" href="slider.php">Slider</a></li>
          <li><a class="dropdown-item fw-bold" href="daftar_produk.php">Daftar Produk</a></li>
          <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
          <li><a class="dropdown-item" href="profilPerusahaan.php">Profil Perusahaan</a></li>
          <li><a class="dropdown-item" href="hubungiKami.php">Hubungi Kami</a></li>
        </ul>
      </li>
    </ul>

    <!-- Admin Info & Logout -->
    <div class="d-flex align-items-center">
        <i class="bi bi-person-circle fs-5 text-black me-2"></i>
            <form id="logoutForm" action="class/logout.php" method="post" class="d-inline me-4">
            <button type="submit" class="btn-logout btn-sm d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
  </div>
</nav>

<!-- Navbar End -->

<div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-black fw-bold">Daftar Produk</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data
            </button>
        </div>

        <div class="table-responsive">
            <table id="dataBlog" class="table table-hover table-bordered align-middle shadow-sm bg-white rounded">
                <thead class="table-success text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Judul Home</th>
                        <th style="width: 30%;">Deskripsi Judul</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- Data akan diisi dengan JavaScript -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createForm" method="post" action="class/manageProduk.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul_home" class="form-label">Judul Home</label>
                            <input type="text" class="form-control" id="judul_home" name="create_judul_home" required />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_judul" class="form-label">Deskripsi Judul</label>
                            <textarea class="form-control" id="deskripsi_judul" name="create_deskripsi_judul" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="create_gambar" accept="image/*" required />
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="create_status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="createProduk" name="create_produk" value="create_produk" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="updateForm" method="post" action="class/updateProduk.php" enctype="multipart/form-data">
                <input type="hidden" id="update_id_home" name="update_id_home" />
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update_judul_home" class="form-label">Judul Home</label>
                            <input type="text" class="form-control" id="update_judul_home" name="update_judul_home" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_deskripsi_judul" class="form-label">Deskripsi Judul</label>
                            <textarea class="form-control" id="update_deskripsi_judul" name="update_deskripsi_judul" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="update_gambar" class="form-label">Gambar (biarkan kosong jika tidak ingin mengganti)</label>
                            <input type="file" class="form-control" id="update_gambar" name="update_gambar" accept="image/*" />
                            <div id="current_image" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label for="update_status" class="form-label">Status</label>
                            <select class="form-select" id="update_status" name="update_status" required>
                                <option selected value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="update_produk" value="update_produk" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
      <footer class="footer bg-dark text-dark text-center py-3 shadow-sm mt-5" style="position: static; width: 100%; z-index: 1030;">
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
$(document).ready(function () {
    loadProdukData();
});
        
        // Crete Produk
        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            formData.append('create_produk', "create_produk");

            fetch('class/manageProduk.php', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json()) // Ubah dari text() ke json()
            .then(response => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Di Tambahkan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        document.getElementById('createModal').querySelector('.btn-close').click(); // Tutup modal
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

        // Edit Produk
        document.getElementById('updateModal').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            formData.append('update_produk', "update_produk");

            fetch('class/updateProduk.php', {
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
                        document.getElementById('updateModal').querySelector('.btn-close').click(); // Tutup modal
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

        document.addEventListener('DOMContentLoaded', function () {
    loadProdukData();
});

function loadProdukData() {
    fetch('class/getProduk.php')
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);

            // Hapus DataTable lebih dulu sebelum isi data
            if ($.fn.DataTable.isDataTable('#dataBlog')) {
                $('#dataBlog').DataTable().clear().destroy();
            }

            const tbody = document.querySelector('#dataBlog tbody');
            tbody.innerHTML = '';

            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="align-middle text-center">${index + 1}</td>
                    <td class="align-middle text-center">${item.judul_home}</td>
                    <td class="align-middle text-start">${item.deskripsi_judul}</td>
                    <td class="align-middle text-center"><img src="${item.gambar}" width="100"></td>
                    <td class="align-middle text-center" style="text-transform: capitalize">${item.status}</td>
                    <td class="align-middle text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="loadEditProduk(${item.id_home})" class="btn btn-sm btn-warning">Edit</button>
                        <button type="button" onclick="hapusProduk(${item.id_home})" class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Inisialisasi ulang DataTables setelah isi data
            $('#dataBlog').DataTable();
        })
        .catch(error => {
            console.error('Gagal memuat data produk:', error);
        });
}
        function loadEditProduk(target_id) {
            fetch('class/getProduk.php')
            .then(response => response.json())
            .then(data => {
                const idToFind = target_id; // id_home
                const produkItem = data.find(item => parseInt(item.id_home) === idToFind);

                if (!produkItem) {
                    alert("Data tidak ditemukan.");
                    return;
                }

                // Fill the form fields
                document.getElementById('update_id_home').value = produkItem.id_home;
                document.getElementById('update_judul_home').value = produkItem.judul_home;
                document.getElementById('update_deskripsi_judul').value = produkItem.deskripsi_judul;
                document.getElementById('update_status').value = produkItem.status;

                // Show current image preview
                const imgPreview = `
                    <p class="mb-1">Gambar Saat Ini:</p>
                    <img src="${produkItem.gambar}" alt="Gambar Produk" class="img-fluid rounded border" style="max-height:150px;">
                `;
                document.getElementById('current_image').innerHTML = imgPreview;
            })
            .catch(error => console.error('Fetch error:', error));
        }

        document.addEventListener('DOMContentLoaded', loadProdukData);

        
      function hapusProduk(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`class/delete_produk.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            loadProdukData(); // Reload tabel saja
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Telah Berhasil Di Hapus!',
                            text: data.message || 'Gagal menghapus data.'
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
        }
    });
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

</script>
     
</body>
</html>