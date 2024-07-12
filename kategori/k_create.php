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
    $nama_kategori = $_POST['nama_kategori'];
    $keterangan = $_POST['keterangan'];

    // Query untuk menambahkan data
    $sql = "INSERT INTO kategori (nama_kategori, keterangan) VALUES (?, ?)";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("ss", $nama_kategori, $keterangan);

    if ($stmt->execute()) {
        echo "<script>alert('Data kategori berhasil ditambahkan.');</script>";
        header("Location: k_read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }

    $stmt->close();
    $konek->close();
}
?>

<html>
<head>
    <title>:: Tambah Kategori ::</title>
	<link rel="stylesheet" href="../assets/css/fbarang.css">
</head>
<body bgcolor="#fff">
    <center>
	    <h2 align="center">INPUT DATA KATEGORI</h2>
		<?php
		    echo"<h5>Hai : " . $_SESSION['username'];
		?>
		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_7k8jk8vi.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>

	    <div class="glass">
			<form method="POST" action="#" enctype="multipart/form-data">
				<table>
					<tr>
						<td align="top">Nama Kategori</td>
						<td><input type="text" name="nama_kategori" size="30"></td>
					</tr>
					<tr>
						<td> Keterangan </td>
						<td><textarea name="keterangan" rows="4" cols="30"></textarea></td>
					</tr>
					<tr>
						<td colspan=2 align='right'>
							<input id="simpan" type="submit" name="submit" value="Simpan">
							<button type="button" onclick="history.back();">Cancel</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>