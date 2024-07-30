<?php
//---------------------------------//
session_start();
if ($_SESSION['level'] != 'admin') {
	header("Location: ../menu.php");
	exit();
}
//---------------------------------//

include "../config/koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $keterangan = $_POST['keterangan'];

    // Query untuk memperbarui data
    $sql = "UPDATE kategori SET nama_kategori=?, keterangan=? WHERE id_kategori=?";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("ssi", $nama_kategori, $keterangan, $id_kategori);

    if ($stmt->execute()) {
        echo "<script>alert('Data kategori berhasil diperbarui.');</script>";
        header("Location: k_read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }

    $stmt->close();
    $konek->close();
}

$id_kategori = $_GET['id_kategori'];
if (!isset($id_kategori) || !is_numeric($id_kategori)) {
    die("Invalid ID.");
}

$edit = mysqli_query($konek, "SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
$ket = mysqli_fetch_array($edit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="../assets/css/ebarang.css">
</head>
<body>
    <center>
        <h2>Edit Kategori</h2>
        <h5>Login Sebagai: <?php echo htmlspecialchars($_SESSION['username']); ?></h5>
        <div class="glass">
            <form method="POST" enctype="multipart/form-data" name="update" action="#">
                <input type="hidden" name="id_kategori" value="<?php echo htmlspecialchars($ket['id_kategori']); ?>">
                <table align="center" border="0" id="table">
                    <tr>
                        <td valign="top">Nama Kategori</td>
                        <td><input type="text" name="nama_kategori" size="30" value="<?php echo htmlspecialchars($ket['nama_kategori']); ?>"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><textarea name="keterangan" rows="4" cols="30"><?php echo htmlspecialchars($ket['keterangan']); ?></textarea></td>
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
                <!-- Add any additional buttons or links here -->
            </table>
        </div>
    </center>
</body>
</html>
