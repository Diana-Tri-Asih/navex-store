<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    body {
      background-color: #f8f9fa; 
    }

    .login-container {
      display: flex;
      justify-content: space-between;
      margin: 100px 150px;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    }

    .login-form {
      width: 45%;
    }

    .card-container {
      width: 45%;
    }

    .btn-masuk {
      background-color: #dc3545; 
      color: white;
      border: none;
      width: 100%;
    }

    .btn-masuk:hover {
      background-color: #c82333;
      color: white;
      transition: all 0.3s ease-in-out;
    }

    .card-container img {
      max-width: 150px;
    }

    .card {
      margin-top: 20px;
    }
  </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light navbar-expand-lg shadow-sm">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/logo.jpeg" style="height: 55px; width: 100px; margin-left: 15px" alt="NAVEX Geforce" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold" href="login.html">Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold" href="pendaftaran.html">Daftar</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-danger" type="submit">Cari</button>
      </form>
    </div>
  </div>
</nav>
<!-- Navbar end -->

    <!-- Login -->
    <div class="login-container row">
      <!-- Login Form -->
      <form action="class/login.php" class="login-form" method="post" id="formLogin" class="col-md-4">
        <h1 style="text-align: center">Login Customer</h1>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" />
        </div>
        <button type="submit" name="login" id="submitLogin" class="btn btn-danger btn-masuk">Masuk</button>
      </form>

      <!-- Card -->
      <div class="card card-container col-md-8">
        <div class="row g-0">
          <div class="d-flex align-items-center col-md-4">
            <img src="img/tentang.jpg" class="img-fluid rounded-start" alt="Card image" />
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Selamat datang di portal pelanggan resmi NAVEX</h5>
              <p class="card-text">Kami berkomitmen untuk memberikan pengalaman terbaik bagi Anda dalam mengakses layanan, produk, dan 
                informasi terbaru dari kami. Masuk ke akun Anda untuk menikmati fitur eksklusif kami. </p>
              <a href="#" class="card-link">Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Login End -->

    <!-- Footer -->
      <footer class="footer bg-dark text-dark text-center py-3 shadow-sm" style="position: fixed; bottom: 0; width: 100%; z-index: 1030;">
        <div class="container">
          <h5 class="card-title text-center text-white">NAVEX</h5>
          <p class="card-text text-center text-light">© NAVEX Indonesia</p>
        </div>
      </footer>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script>
        const formLogin = document.querySelector("#formLogin");
        const btnSubmit = document.querySelector("#submitLogin");

        btnSubmit.addEventListener("click", function(e){
          e.preventDefault();
          submitFormData();
        })

        function submitFormData() {
          // Gather the form data
          const formData = new FormData(formLogin);

          formData.append("login", "submit");
          // Use fetch to submit the form via AJAX
          fetch('Admin/class/login.php', {
            method: 'POST',
            body: formData
            })
          .then(response => response.json()) // Parse the JSON response
          .then(data => {
              // Check if the operation was successful
              if (data.success) {
                    window.location.href = data.redirect_url;
                    submitForm = false;
              } else {
                  Swal.fire({
                      title: 'Gagal!',
                      text: data.message.join('\n'), // Join all messages if there are multiple
                      icon: 'error',
                      confirmButtonColor: '#d33'
                  })

                  submitForm = false;
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
  </body>
</html>
