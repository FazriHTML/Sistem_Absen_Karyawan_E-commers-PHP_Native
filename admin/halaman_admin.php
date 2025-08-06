<?php
session_start();
if($_SESSION['level']==""){
  header("location:index.php?pesan=gagal");
  }
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" href="../img/wk.png" sizes="32x32" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="theme-color" content="#000000" />
  <title>Admin</title>
  <meta name="description" content="Mobilekit HTML Mobile UI Kit" />
  <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
  <link rel="icon" type="image/png" href="img/wk.png" sizes="32x32" />
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png" />
  <link rel="stylesheet" href="assets/css/inc/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/inc/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="assets/css/inc/owl-carousel/owl.theme.default.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
  <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">Selamat Datang Admin</a>
        <a class="navbar-brand ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg></a>
        <a class="navbar-brand"><?php echo $_SESSION['username']; ?></a>
      </div>
    </nav>
<!-- isi -->
<div class="container my-5 bg-info">
  <div class="p-5 text-center bg-body-secondary rounded-3">
    <svg class="bi mt-1 mb-3" style="color: var(--bs-indigo);" width="0" height="0"><use xlink:href="#bootstrap"/></svg>
    <h1><p class="col-md-lg-8 mx-auto fs-5 text-muted">
      DATA AKUN PEGAWAI
    </p>
    <div class="d-inline-flex gap-2 mb-5">
    <button type="button" class="btn btn-outline-primary">Chek</button>
    </div>
  </div>
</div>

<!-- isi -->
<div class="container my-5 bg-info">
  <div class="p-5 text-center bg-body-secondary rounded-3">
    <svg class="bi mt-1 mb-3" style="color: var(--bs-indigo);" width="0" height="0"><use xlink:href="#bootstrap"/></svg>
    <h1><p class="col-md-lg-8 mx-auto fs-5 text-muted">
      DATA AKUN PEMBELI 
    </p>
    <div class="d-inline-flex gap-2 mb-5">
    <button type="button" class="btn btn-outline-primary">Chek</button>
    </div>
  </div>
</div>
<!-- isi -->
<div class="container my-5 bg-info">
  <div class="p-5 text-center bg-body-secondary rounded-3">
    <svg class="bi mt-1 mb-3" style="color: var(--bs-indigo);" width="0" height="0"><use xlink:href="#bootstrap"/></svg>
    <h1><p class="col-md-lg-8 mx-auto fs-5 text-muted">
      REKAP PENJUALAN 
    </p>
    <div class="d-inline-flex gap-2">
    <button type="button" class="btn btn-outline-primary">Chek</button>
    </div>
  </div>
</div>
<div class="container my-5 bg-info">
  <div class="p-5 text-center bg-body-secondary rounded-3">
    <svg class="bi mt-1 mb-3" style="color: var(--bs-indigo);" width="0" height="0"><use xlink:href="#bootstrap"/></svg>
    <h1><p class="col-md-lg-8 mx-auto fs-5 text-muted">
      INPUT DATA PEGAWAI 
    </p>
    <div class="d-inline-flex gap-2">
    <button type="button" class="btn btn-outline-primary"><a href="crud_pegawai.php">Chek</a></button>
    </div>
  </div>
</div>
<!-- Jumbotron -->
  
<!-- Akhir Jumbotron -->

<!-- footer -->
<div class="appBottomMenu">
    <a href="#" class="item">
      <div class="col">
        <i class="fas fa-home fa-3x"></i>
        <strong>Home</strong>
      </div>
    </a>
    <a href="#" class="item active">
      <div class="col">
        <i class="fas fa-calendar-alt fa-3x"></i>
        <strong>Calendar</strong>
      </div>
    </a>
    <a href="#" class="item">
      <div class="col">
        <div class="action-button large">
          <i class="fas fa-camera text-white fa-3x"></i>
        </div>
      </div>
    </a>
    <a href="#" class="item">
      <div class="col">
        <i class="fas fa-file-alt fa-3x"></i>
        <strong>Docs</strong>
      </div>
    </a>
    <a href="javascript:;" class="item">
      <div class="col">
        <i class="fas fa-user-tie fa-3x"></i>
        <strong>Profile</strong>
      </div>
    </a>
  </div>
<!-- Akhir Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
