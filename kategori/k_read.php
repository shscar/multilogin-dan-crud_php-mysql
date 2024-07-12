<?php
//---------------------------------//
session_start();
if ($_SESSION['level'] != 'admin') {
	header("Location: menu.php");
	exit();
}
//---------------------------------//

include "../config/koneksi.php";
$kategori = "SELECT * FROM kategori";
$result = $konek->query($kategori);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    
    <link rel="stylesheet" href="../assets/css/tbarang.css">
    <style>
        /* Styling untuk Edit dan Hapus */
        .action-links a {
            text-decoration: none;
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #333;
        }
        .action-links a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <center>
        <h2>DATA KATEGORI</h2>
            <table>
                <button onclick="location.href='k_create.php'">Tambah Kategori</button>
                <button onclick="location.href='../menu.php'">Menu</button>
                <button onclick="location.href='../logout.php'">LogOut</button>

            </table>
        <?php
        if ($result->num_rows > 0) {
            echo "<div id='container'>
                <table class='styled-table' border=0>
                    <tr class='judul'>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>";
            
                    $no = 1;
                    while ($kat = $result->fetch_assoc()) {
                    echo "<tr class='isi'>
                            <td>" . $no . "</td>
                            <td>" . $kat['nama_kategori'] . "</td>
                            <td>" . $kat['keterangan'] . "</td>
                            <td class='action-links'>
                                <a href='k_update.php?id_kategori=" . $kat['id_kategori'] . "'>Edit</a> <span>|</span>
                                <a href='k_delete.php?id_kategori=" . $kat['id_kategori'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                            </td>
                        </tr>";
                    $no++;
                }
            echo "</div></table>";
        } else {
            echo "Tidak ada data kategori.";
        }

        $konek->close();
        ?>
    <center>
</body>
</html>
