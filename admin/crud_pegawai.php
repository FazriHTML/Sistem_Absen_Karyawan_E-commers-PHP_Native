<?php 
// koneksinya 
$koneksi=mysqli_connect('localhost','root','','database_pem12'); 
?> 

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="../assets/js/color-modes.js"></script>
    <link rel="icon" type="image/png" href="../img/wk.png" sizes="32x32" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Form Input Data Pegawai</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --warning-color: #f8961e;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --gradient-primary: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        --gradient-secondary: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
        --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 10px 15px rgba(0, 0, 0, 0.1);
        --shadow-heavy: 0 20px 25px rgba(0, 0, 0, 0.15);
      }

      body {
        background: var(--gradient-secondary);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        transition: all 0.3s ease;
      }

      .form-signin {
        max-width: 900px;
        padding: 2rem;
      }

      .card-custom {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: var(--shadow-heavy);
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      }

      .form-floating {
        margin-bottom: 1.2rem;
      }

      .form-floating > .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        padding: 1rem 0.75rem;
      }

      .form-floating > .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
      }

      .form-floating > label {
        padding: 1rem 0.75rem;
        color: #6c757d;
        transition: all 0.3s ease;
      }

      .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 1rem 0.75rem;
        transition: all 0.3s ease;
      }

      .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
      }

      .btn-primary {
        background: var(--gradient-primary);
        border: none;
        border-radius: 10px;
        padding: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
      }

      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        background: var(--secondary-color);
      }

      .btn-outline-warning, .btn-outline-danger {
        border-radius: 8px;
        transition: all 0.3s ease;
        margin: 0 3px;
      }

      .btn-outline-warning:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(248, 150, 30, 0.3);
      }

      .btn-outline-danger:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(247, 37, 133, 0.3);
      }

      .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        margin-top: 2rem;
      }

      .table thead {
        background: var(--gradient-primary);
        color: white;
      }

      .table th {
        border: none;
        padding: 1rem;
        font-weight: 600;
      }

      .table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        border-color: #e9ecef;
      }

      .table tbody tr {
        transition: all 0.2s ease;
      }

      .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
        transform: translateX(5px);
      }

      .logo {
        transition: transform 0.5s ease;
      }

      .logo:hover {
        transform: rotate(15deg) scale(1.1);
      }

      h1 {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        margin-bottom: 1.5rem !important;
      }

      .floating-label {
        position: relative;
        margin-bottom: 1.5rem;
      }

      .floating-label input, .floating-label select {
        height: 60px;
        padding-top: 24px;
      }

      .floating-label label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 20px 12px;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .15s ease-in-out, transform .15s ease-in-out;
      }

      .floating-label input:focus ~ label,
      .floating-label input:not(:placeholder-shown) ~ label,
      .floating-label select:focus ~ label,
      .floating-label select:not([value=""]) ~ label {
        transform: scale(.85) translateY(-.8rem) translateX(.15rem);
        color: var(--primary-color);
        font-weight: 600;
      }

      .pulse {
        animation: pulse 2s infinite;
      }

      @keyframes pulse {
        0% {
          box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7);
        }
        70% {
          box-shadow: 0 0 0 10px rgba(67, 97, 238, 0);
        }
        100% {
          box-shadow: 0 0 0 0 rgba(67, 97, 238, 0);
        }
      }

      .fade-in {
        animation: fadeIn 0.8s ease-in;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }

      .success-message {
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--success-color);
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: var(--shadow-medium);
        z-index: 1000;
        transform: translateX(150%);
        transition: transform 0.5s ease;
      }

      .success-message.show {
        transform: translateX(0);
      }

      .back-button {
        background: var(--gradient-primary);
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 1rem;
      }

      .back-button:hover {
        transform: translateX(-5px);
        box-shadow: var(--shadow-medium);
      }

      @media (max-width: 768px) {
        .form-signin {
          padding: 1rem;
        }
        
        .table-responsive {
          font-size: 0.875rem;
        }
        
        .btn {
          padding: 0.5rem 1rem;
        }
      }
    </style>
  </head>
  <body class="d-flex align-items-center py-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    <main class="form-signin w-100 m-auto fade-in">
      <div class="card card-custom p-4">
        <form method="POST" action="tambahdata_pegawai.php" id="pegawaiForm">
          <center>
            <img class="mb-4 logo" src="../img/wk.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Form Input Data Pegawai Dan Pembeli</h1>
          </center>

          <div class="row">
            <div class="col-md-6">
              <div class="floating-label">
                <input type="text" class="form-control" id="floatingInput" placeholder=" " name="id" required>
                <label for="floatingInput">ID</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="floating-label">
                <input type="text" class="form-control" id="floatingNama" placeholder=" " name="nama" required>
                <label for="floatingNama">Nama Lengkap</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="floating-label">
                <input type="text" class="form-control" id="floatingUsername" placeholder=" " name="username" required>
                <label for="floatingUsername">Username</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="floating-label">
                <input type="password" class="form-control" id="floatingPassword" placeholder=" " name="password" required>
                <label for="floatingPassword">Password</label>
              </div>
            </div>
          </div>

          <div class="floating-label">
            <select class="form-select" id="floatingLevel" name="level" required>
              <option value="" selected disabled></option>
              <option value="pegawai">Pegawai</option>
              <option value="pembeli">Pembeli</option>
              <option value="admin">Admin</option>
              <option value="face">Interface</option>
            </select>
            <label for="floatingLevel">Level</label>
          </div>

          <button class="btn btn-primary w-100 py-2 pulse" type="submit" name="submit" id="submitBtn">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah Data
          </button>
        </form>

        <div class="mt-4">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr class="table-primary"> 
                  <th scope="col">ID</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Level</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $q = $koneksi->query("SELECT * FROM user"); 
                while ($dt = $q->fetch_assoc()) : 
                ?>
                <tr class="fade-in">
                  <td><?= $dt['id'] ?></td>
                  <td><?= $dt['nama'];?></td>
                  <td><?= $dt['username'];?></td>
                  <td>••••••••</td>
                  <td><span class="badge bg-primary"><?= $dt['level'];?></span></td>
                  <td>
                    <center>
                      <a href="update.php?id=<?=$dt['id']?>" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <a href="delete.php?id=<?=$dt['id']?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash3"></i>
                      </a>
                    </center>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          
          <a href="halaman_admin.php" class="btn back-button">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Halaman Utama
          </a>
        </div>
      </div>
    </main>

    <div class="success-message" id="successMessage">
      <i class="bi bi-check-circle-fill me-2"></i>Data berhasil ditambahkan!
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Animasi untuk form submission
      document.getElementById('pegawaiForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulasi pengiriman data (dalam implementasi nyata, ini akan dikirim ke server)
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
        submitBtn.disabled = true;
        
        // Simulasi delay pengiriman data
        setTimeout(function() {
          // Tampilkan pesan sukses
          const successMessage = document.getElementById('successMessage');
          successMessage.classList.add('show');
          
          // Reset form
          document.getElementById('pegawaiForm').reset();
          
          // Reset tombol
          submitBtn.innerHTML = '<i class="bi bi-person-plus-fill me-2"></i>Tambah Data';
          submitBtn.disabled = false;
          
          // Sembunyikan pesan sukses setelah 3 detik
          setTimeout(function() {
            successMessage.classList.remove('show');
          }, 3000);
        }, 1500);
      });

      // Efek hover untuk card
      const card = document.querySelector('.card-custom');
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });

      // Animasi untuk baris tabel saat dihover
      const tableRows = document.querySelectorAll('tbody tr');
      tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
          this.style.transform = 'translateX(5px)';
        });
        
        row.addEventListener('mouseleave', function() {
          this.style.transform = 'translateX(0)';
        });
      });

      // Efek untuk logo
      const logo = document.querySelector('.logo');
      logo.addEventListener('mouseenter', function() {
        this.style.transform = 'rotate(15deg) scale(1.1)';
      });
      
      logo.addEventListener('mouseleave', function() {
        this.style.transform = 'rotate(0) scale(1)';
      });
    </script>
  </body>
</html>