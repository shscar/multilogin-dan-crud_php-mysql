<?php
    include "../config/koneksi.php";
    // --------------------------- //
    session_start();
    if ($_SESSION['level'] = 'user') {
        header("Location: index.php");
        exit();
    }
    // --------------------------- //

    $id_kategori = $_GET["id_kategori"];
    if( hapus_k($id_kategori) > 0 ) {
    echo"<script>
        alert('data berhasil dihapus!');
        document.location.href = 'index.php';
    </script>";
    
    } else {
    echo"<script>
        alert('data gagal dihapus!');
        document.location.href = 'index.php';
    </script>";

    } 
?>
