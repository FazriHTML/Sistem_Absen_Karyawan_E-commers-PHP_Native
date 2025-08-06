<?php 
$koneksi=mysqli_connect('localhost','root','','database_pem12');
 if (isset($_POST['submit'])) {  
  $id = $_POST['id']; 
  $nama = $_POST['nama']; 
  $username = $_POST['username']; 
  $password = $_POST['password'];
  $level = $_POST['level'];
 
// id_produk bernilai '' karena kita set auto increment 
$queryinput="INSERT INTO user(id,nama,username,password,level) 
VALUES ('$id', '$nama', '$username', '$password', '$level')"; 
  $q=mysqli_query($koneksi,$queryinput); if ($q) { 
    // pesan jika data tersimpan 
    echo "<script>alert('Data pegawai berhasil ditambahkan'); window.location.href='crud_pegawai.php'</script>"; 
  } else { 
    // pesan jika data gagal disimpan 
    echo "<script>alert('Data pegawai ditambahkan'); window.location.href='crud_pegawai.php'</script>"; 
  } 
} else { 
  // jika coba akses langsung halaman ini akan diredirect ke halaman index 
    header('Location: crud_pegawai.php'); 
} 
 
