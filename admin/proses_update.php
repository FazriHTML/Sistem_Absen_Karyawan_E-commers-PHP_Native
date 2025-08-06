<?php
$koneksi=mysqli_connect('localhost','root','','database_pem12');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Ensure all variables are sanitized before using them in the query
    $id = mysqli_real_escape_string($koneksi, $id);
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi,$password);
    $level = mysqli_real_escape_string($koneksi, $level);

    // Update query
    $query = "UPDATE user SET nama='$nama', username='$username', password='$password', level='$level' WHERE id ='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='crud_pegawai.php'</script>";
      } else {
      // pesan jika data gagal diubah
      echo "<script>alert('Data  gagal diubah'); window.location.href='crud_pegawai.php'</script>";
      }
   }  
  else {
 // jika coba akses langsung halaman ini akan diredirect ke halaman crud
 header('Location: crud_pegawai.php');
}
?>