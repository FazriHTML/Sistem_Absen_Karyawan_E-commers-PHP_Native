<?php 
$koneksi=mysqli_connect('localhost','root','','database_pem12'); if (isset($_GET['id'])) { 
  $id = $_GET['id']; 
// perintah hapus data berdasarkan id yang dikirimkan 
  $q = $koneksi->query("DELETE FROM user WHERE id='$id'"); 
// cek perintah 
  if ($q) { 
    // pesan apabila hapus berhasil 
    echo "<script>alert('Data berhasil dihapus'); window.location.href='crud_pegawai.php'</script>"; 
  } else { 
    // pesan apabila hapus gagal 
    echo "<script>alert('Data berhasil dihapus'); window.location.href='crud_pegawai.php'</script>"; 
  } 
} else { 
  // jika mencoba akses langsung ke file ini akan diredirect ke halaman utama  
   header('Location:crud_pegawai.php'); 
} 
?> 
 
