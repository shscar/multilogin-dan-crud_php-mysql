<?php
    session_start();
    if ($_SESSION['level'] = 'user') {
        header("Location: index.php");
        exit();
    }
    include "../config/koneksi.php";

    $id = $_GET["id"];
    if (hapus($id)) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'index.php';
        </script>";
    }
?>
