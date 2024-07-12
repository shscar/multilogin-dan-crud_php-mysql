<?php
//---------------------------------//
session_start();
if ($_SESSION['level'] != 'admin') {
	header("Location: ../menu.php");
	exit();
}
//---------------------------------//

include "../config/koneksi.php";
if( isset($_GET['id_kategori']) ){

    // ambil id dari query
    $id_kategori = $_GET['id_kategori'];

    // buat query hapus
    $sql = "DELETE FROM kategori WHERE id_kategori=$id_kategori";
    $query = mysqli_query($konek, $sql);

    if( $query ){
        echo"<script>
            alert('data berhasil dihapus!');
            document.location.href = 'k_read.php';
        </script>";
    } else {
        echo"<script>
            alert('gagal menghapus data!');
            document.location.href = 'k_read.php';
        </script>";
    }

} else {
    die("Sorry ...");
}
?>
