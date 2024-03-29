<?php
session_start();

    if( isset($_SESSION["login"]) ) {
      echo "<meta http-equiv= 'refresh' content='1;url=http://localhost/projectdesa_db/pages/content/dashboard/dashboard'>";
      die;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login - SIDAK PAGADUNGAN</title>
  <link href="assets/img/hero-img.png" rel="icon">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/hero-img.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index" class="logo d-flex align-items-center w-auto">
                  <img src="assets/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SIDAK PAGADUNGAN</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun Anda</h5>
                    <p class="text-center small">Masukkan Email & Password Anda Untuk Login</p>
                  </div>
                  <?php
                                    $isError = isset($_GET['error']) && $_GET['error'] == '1';
                                    $isInvalidCredentials = isset($_GET['error']) && $_GET['error'] === 'invalid_credentials';
                                    ?>
                                    <?php if ($isError): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Password Salah!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>

                                        <script>
                                        // Menghapus parameter error dari URL setelah alert ditutup
                                        const url = new URL(window.location.href);
                                        const params = new URLSearchParams(url.search);
                                        params.delete('error');
                                        url.search = params.toString();
                                        window.history.replaceState({}, document.title, url.href);

                                        // Menghilangkan alert setelah 2000 milidetik (2 detik)
                                        setTimeout(function() {
                                            document.querySelector('.alert-danger').style.display = 'none';
                                        }, 10000);
                                        </script>
                                    </div>
                                    <?php endif; ?>
                                    <!-- Alert Email dan password salah -->
                                    <?php if ($isInvalidCredentials): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Email atau Password Salah!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>

                                        <script>
                                        // Menghapus parameter error dari URL setelah alert ditutup
                                        const url = new URL(window.location.href);
                                        const params = new URLSearchParams(url.search);
                                        params.delete('error');
                                        url.search = params.toString();
                                        window.history.replaceState({}, document.title, url.href);

                                        // Menghilangkan alert setelah 2000 milidetik (2 detik)
                                        setTimeout(function() {
                                            document.querySelector('.alert-danger').style.display = 'none';
                                        }, 10000);
                                        </script>
                                    </div>
                                    <?php endif; ?>
                  <form action="backend/login" class="row g-3 needs-validation" novalidate method="post">

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope-at"></i></span>
                        <input type="text" name="email" class="form-control" id="yourUsername" placeholder="Email" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key"></i></span>
                        <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                      </div>
                    </div>
                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="center">
                      <!-- <button class="btn btn-primary w-100" type="submit">Login</button> -->
                      <a href="index" class="btn btn-secondary">Kembali</a>
                      <input name="submit" value="Login" class="btn btn-primary" type="submit"></input>
                    </div>
                  </form>

                </div>
              </div>

              <div class="center-end text-center">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://www.instagram.com/aldysptraaa_/" target="_blank" >M. Aldy Saputra</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/assets/vendor/quill/quill.min.js"></script>
  <script src="assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/assets/js/main.js"></script>

</body>

</html>