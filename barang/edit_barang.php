<?php
    //------------------------//
    session_start();
    if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'pegawai')) {
        header("Location: index.php");
        exit();
    }
    //-----------------------//
    include "../config/koneksi.php";

    $id = $_GET['id'];
    if (!isset($id) || !is_numeric($id)) {
        die("Invalid ID.");
    }

    $edit  = mysqli_query($konek, "SELECT * FROM barang WHERE idbarang='$id'");
    $row   = mysqli_fetch_array($edit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../assets/css/ebarang.css">
</head>
<body>
    <center>
        <h2>Edit Barang</h2>
        <h5>Login Sebagai: <?php echo htmlspecialchars($_SESSION['username']); ?></h5>
        <div class="glass">
            <form method="POST" enctype="multipart/form-data" name="update" action="update_barang.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['idbarang']); ?>">
                <table align="center" border="0" id="table">
                    <tr>
                        <td valign="top">Nama Barang</td>
                        <td><input type="text" name="barang" size="30" value="<?php echo htmlspecialchars($row['namabrg']); ?>"></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>
                            <select name="kategori">
                                <?php
                                $tampil = mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
                                while ($c = mysqli_fetch_array($tampil)) {
                                    $selected = ($row['id_kategori'] == $c['id_kategori']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($c['id_kategori']) . "' $selected>" . htmlspecialchars($c['nama_kategori']) . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input type="text" name="jumlah" size="15" value="<?php echo htmlspecialchars($row['jumlah']); ?>"></td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td><input type="text" name="brand" size="15" value="<?php echo htmlspecialchars($row['brand']); ?>"></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="text" name="harga" size="15" value="<?php echo htmlspecialchars($row['harga']); ?>"></td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td><img src="gambar/<?php echo htmlspecialchars($row['gambar']); ?>" width="200" height="200"></td>
                    </tr>
                    <tr>
                        <td>Ganti Gambar</td>
                        <td><input type="file" name="fupload"></td>
                    </tr>
                    <tr>
                        <td colspan="2"># Jika Tidak ingin mengubah gambar silahkan abaikan saja</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input id="update" type="submit" value="Perbarui">
                            <button type="button" onclick="history.back();">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br><br>
            <table>

                <!-- <form method="POST" action="menu.php">
                    <button>Menu Utama</button>
                </form>
                <form method="POST" action="tampil_barang.php">
                    <button>Tampil Barang</button>
                </form> -->
            </table>
        </div>
    </center>
</body>
</html>
