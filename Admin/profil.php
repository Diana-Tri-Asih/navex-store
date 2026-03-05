<?php
include "include/checkLogin.php";
include 'class/dbh.php';
$id_user = $_SESSION ['id_username'];
$sql = "SELECT * FROM user WHERE id_username = '$id_user'";
$query = mysqli_query($connection,$sql);
$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
      body {
        background-color: #f2f2f2;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

     
      .card-profile {
        max-width: 600px;
        margin: 60px auto;
        background-color: #fff;
        border-radius: 15px;
      }

      .card-profile img {
        width: 80px;
        height: 80px;
        object-fit: cover;
      }

      .card-profile h5 {
        margin-bottom: 5px;
      }

      .card-profile p {
        margin-bottom: 8px;
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

      .px-2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      }

      .px-2 p {
        width: 100%;
        text-align: justify;
      }

      .navbar {
        background-color: #f8f9fa !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .navbar .nav-link,
      .navbar .navbar-brand {
        color: #212529 !important;
        font-weight: 500;
      }
    </style>
  </head>
  <body>
    <div class="d-flex">

    <!-- Main Content -->
    <div class="content w-100">
      <!-- Navbar -->
      <nav class="navbar navbar-light navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="img/logo.jpeg" style="height: 55px; width: 100px; margin-left: 15px" alt="NAVEX" />
        </a>
          <!-- Dropdown Menu -->
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="home.html">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master
              </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item fw-bold" href="profil.php">Edit Profil</a></li>
          <li><a class="dropdown-item" href="slider.php">Slider</a></li>
          <li><a class="dropdown-item" href="daftar_produk.php">Daftar Produk</a></li>
          <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
          <li><a class="dropdown-item" href="profilPerusahaan.php">Profil Perusahaan</a></li>
          <li><a class="dropdown-item" href="hubungiKami.php">Hubungi Kami</a></li>
        </ul>
      </li>
    </ul>

        <!-- Admin Info & Logout -->
          <div class="d-flex align-items-center gap-3">
            <img src="<?= $data['foto_profil'] ?>" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
            <form action="class/logout.php" method="post" class="m-0">
              <button type="submit" class="btn-logout btn-sm d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </button>
            </form>
          </div>
        </div>
      </nav>

        <!-- Profile Card -->
        <div class="card card-profile shadow p-4">
          <div class="text-center">
            <img id="profil_gambar_card" src="<?= $data['foto_profil'] ?>" class="rounded-circle mb-3" alt="avatar" />
            <h5></h5>
            <small class="text-muted">Admin</small>
            <div class="mt-3">
            <button type="button" class="modalBtn btn btn-success btn-sm">
              <i class="bi bi-pencil me-1"></i> Edit
            </button>
            </div>
          </div>
          <hr />
          <div class="px-2">
            <p><strong>Nama :</strong> <span id="profil_nama"><?= $data['nama_pengguna'] ?></span></p>
            <p><strong>Username :</strong> <span id="profil_username"><?= $data['username'] ?></span></p>
            <p><strong>Level Pengguna :</strong> <span id="profil_status"><?= $data['status'] ?></span></p>
            <p ><strong>Email :</strong> <span id="profil_email" ><?= $data['email'] ?></span> </p>
            <p ><strong>Alamat :</strong> <span id="profil_alamat"><?= $data['alamat'] ?></span> </p>
          </div>
        </div>
      </div>
    </div>

  <!-- Form Untuk Edit Profile -->
  <div id="modalContainer" class="d-none p-3 position-fixed top-0 left-0 bg-dark w-100 h-100 overflow-y-auto">
    <div class="container d-grid w-full">
      <div class="card p-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="m-0">Edit Profil Admin</h4>
          <button type="button" class="modalBtn btn btn-danger">X</button>
        </div>
        <form  enctype="multipart/form-data" id="formDataUser"  class="d-flex flex-column justify-content-between mt-5 h-100">
          <div class="row">
            <input type="hidden" name="id_username" value="<?= $data['id_username'] ?>">
            <div class="col-6 mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama_pengguna" id="form_nama" value="<?= $data['nama_pengguna'] ?>" required />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username"  id="form_username" value="<?= $data['username'] ?>" required />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="form_email" value="<?= $data['email'] ?>" required />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Old Password</label>
              <input type="password" class="form-control" name="password" id="form_password" value="" />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" class="form-control" name="alamat" id="form_alamat" value="<?= $data['alamat'] ?>" required />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">New Password</label>
              <input type="password" class="form-control" name="newPassword" id="form_newPassword" value=""/>
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Input Select</label>
              <select id="form_status" name="status" class="form-control">
                <option value="admin" selected>Admin</option>  
                <option value="user">User</option>
              </select>
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirmPassword" id="form_confirmPassword" value="" />
            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Image</label>
              <input type="file" class="form-control" name="foto_profil" id="form_fileFoto" />
              <div class="d-flex justify-content-between foto-profil bg-dark mt-3">
                <img id="form_foto" src="<?= $data['foto_profil'] ?>" alt="foto pengguna" style="margin-left: auto; margin-right: auto; width: auto; height: 100%; object-fit: cover;">
              </div>
            </div>
          </div>
          
          <div class="d-flex justify-content-between">
            <button type="button" class="modalBtn btn btn-secondary py-3 px-4">Batal</button>
            <button type="submit" name="edit_user" class="btn btn-success py-3 px-4">Simpan</button>
          </div>
        </form>
      </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
  </body>
</html>
    <!-- Logic Untuk AJAX -->
    <script>
      const modalContainer = document.querySelector("#modalContainer");
      const modalBtn = document.querySelectorAll(".modalBtn");
      let formActive = false;
      modalBtn.forEach(button => {
        button.addEventListener("click", (e) => {
          if(!formActive) {
            modalContainer.classList.toggle("d-none");
            modalContainer.classList.toggle("d-grid");
            formActive = true;
          } else {
            e.preventDefault();
            Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Perubahan yang belum disimpan akan hilang!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#198754', // hijau
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, batal!',
              cancelButtonText: 'Tidak'
            }).then((result) => {
              if (result.isConfirmed) {
                modalContainer.classList.toggle("d-none");
                modalContainer.classList.toggle("d-grid");
                formActive = false;
              }
            })
          }
        })
      })

    // Tambahan Sweat Alret untuk button simpan
    const simpanButton = document.querySelector("button[name='edit_user']");
    const formDataUser = document.querySelector("#formDataUser");
    const reponse = document.querySelector("#response");
    let submitForm = false;
    simpanButton.addEventListener("click", (e) => {
      if(!submitForm){
        e.preventDefault();
        Swal.fire({
          title: 'Simpan Perubahan?',
          text: "Pastikan data sudah benar!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, simpan!', 
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            submitForm = true;
            submitFormData();
          }
        })
      }
    })

    document.querySelector("#form_fileFoto").addEventListener("change", function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader(); // Create a new FileReader instance
            
            // Event listener for when the file is read
            reader.onload = function(e) {
                const imgElement = document.querySelector("#form_foto"); // Get the img element
                imgElement.src = e.target.result; // Update the src to the data URL
            };

            reader.readAsDataURL(file); // Read the file as a data URL
        }
    });

    function submitFormData() {
      // Gather the form data
      const formData = new FormData(formDataUser);

      formData.append("edit_user", "submit");
      // Use fetch to submit the form via AJAX
      fetch('class/editProfile.php', {
      method: 'POST',
      body: formData
      })
      .then(async response => {
          const text = await response.text();
          console.log("RESPONSE RAW:", text);
          let data;
          try {
            data = JSON.parse(text);
          } catch (e) {
            Swal.fire({
              title: 'Gagal!',
              text: 'Respon dari server tidak valid:\n' + text,
              icon: 'error',
              confirmButtonColor: '#d33'
            });
            return;
          }

          if (data.success) {
            Swal.fire({
              title: 'Berhasil!',
              text: data.message.join('\n'),
              icon: 'success',
              confirmButtonColor: '#198754'
            }).then(() => {
              // Update teks profil
              document.querySelector("#profil_gambar_nav").src = data.foto_profil;
              document.querySelector("#profil_gambar_card").src = data.foto_profil;
              document.querySelector("#profil_nama").textContent = formData.get("nama_pengguna");
              document.querySelector("#profil_username").textContent = formData.get("username");
              document.querySelector("#profil_status").textContent = formData.get("status");
              document.querySelector("#profil_email").textContent = formData.get("email");
              document.querySelector("#profil_alamat").textContent = formData.get("alamat");

              // Update form input
              document.querySelector("#form_nama").value = formData.get("nama_pengguna");
              document.querySelector("#form_username").value = formData.get("username");
              document.querySelector("#form_status").value = formData.get("status");
              document.querySelector("#form_email").value = formData.get("email");
              document.querySelector("#form_alamat").value = formData.get("alamat");
              document.querySelector("#form_password").value = "";
              document.querySelector("#form_newPassword").value = "";
              document.querySelector("#form_confirmPassword").value = "";

              // Update gambar jika ada perubahan
              if (data.foto_profil) {
                const filePath = data.foto_profil + "?v=" + new Date().getTime();
                document.querySelector("#form_foto").src = filePath;
                document.querySelector("#profil_gambar").src = filePath;
              }

              submitForm = false;
            });
          } else {
            // Penanganan error...
            Swal.fire({
                title: 'Gagal!',
                text: data.message.join('\n'), // Join all messages 
                icon: 'error',
                confirmButtonColor: '#d33'
            }).then(() => {
              document.querySelector("#profil_gambar_nav").src = data.foto_profil;
              document.querySelector("#profil_gambar_card").src = data.foto_profil;
              document.querySelector("#profil_nama").textContent = formData.get("nama_pengguna");
              document.querySelector("#profil_username").textContent = formData.get("username");
              document.querySelector("#profil_status").textContent = formData.get("status");
              document.querySelector("#profil_email").textContent = formData.get("email");
              document.querySelector("#profil_alamat").textContent = formData.get("alamat");

              document.querySelector("#form_nama").value = formData.get("nama_pengguna");
              document.querySelector("#form_username").value = formData.get("username");
              document.querySelector("#form_status").value = formData.get("status");
              document.querySelector("#form_email").value = formData.get("email");
              document.querySelector("#form_alamat").value = formData.get("alamat");
              document.querySelector("#form_password").value = "";
              document.querySelector("#form_newPassword").value = "";
              document.querySelector("#form_confirmPassword").value = "";
              document.querySelector("#form_foto").src = formData.get("filepath");
              const imgcheck = document.querySelector("#form_fileFoto").value;
              if(imgcheck !== "" && imgcheck !== null){
                if (data.foto_profil) {
                const filePath = data.foto_profil + "?v=" + new Date().getTime();
                document.querySelector("#form_foto").src = filePath;
                document.querySelector("#profil_gambar").src = filePath;
              }
              }
              
              submitForm = false;
            });
          }
      })
      .catch(error => {
          console.error('Error:', error);
          Swal.fire({
              title: 'Error!',
              text: 'There was an issue with the submission.',
              icon: 'error',
              confirmButtonColor: '#d33'
          });
      });
    }
    </script>


  




