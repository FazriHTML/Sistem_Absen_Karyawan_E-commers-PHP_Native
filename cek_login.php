<?php
    session_start();
    include 'koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($koneksi,"select * from user where 
    username='$username' and password='$password'");
    $cek = mysqli_num_rows($login);
    if($cek > 0){
        $data = mysqli_fetch_assoc($login);
        if($data['level']=="admin"){
            $_SESSION['nama'] = $nama; 
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "admin";
            echo '<script>alert("Selamat datang, '.$data['nama'].'");
            location.href="admin/halaman_admin.php";</script>';
        }else if($data['level']=="pembeli"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "pembeli";
            echo '<script>alert("Selamat datang, '.$data['nama'].'");
            location.href="pengurus/halaman_pengurus.html";</script>';
        }else if($data['level']=="pegawai"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "pegawai";
            echo '<script>alert("Selamat datang, '.$data['nama'].'");
            location.href="pegawai/halaman_pegawai.php";</script>';
        }else if($dat['face']=="face"){
            $_SESSION['username'] = $username;
            $_SESSION['face'] = '$face';
            echo '<script>alert("Selamat datang, '.$data['nama'].'");
            location.href="pegawai/halaman_pegawai.php";</script>';
        }else{
            header("location:index.php?pesan=gagal");
        }
    }else{
        header("location:index.php?pesan=gagal");
    }
    
?>