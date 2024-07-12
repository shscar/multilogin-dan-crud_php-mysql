<?php 
//---------------------//
session_start();
if ($_SESSION['level'] != 'admin') {
	header("Location: ../menu.php");
	exit();
}
//------------------//

include "../config/koneksi.php";
$id = $_GET["id"];

if( hapus($id) > 0 ) {
  echo"<script>
    alert('data berhasil dihapus!');
    document.location.href = 'tampil_barang.php';
  </script>";
  
} else {
  echo"<script>
    alert('data gagal dihapus!');
    document.location.href = 'tampil_barang.php';
  </script>";

} 
?>