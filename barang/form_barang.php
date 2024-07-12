<?php
//---------------Cek Login ----------//
session_start();
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'pegawai')) {
	header("Location: ../menu.php");
	exit(); 
}
//---------------------------------//
?>
<html> 
<head>
    <title>:: Tambah Barang ::</title>
	<link rel="stylesheet" href="../assets/css/fbarang.css">
</head>
<body bgcolor="#fff">
    <center>
	    <h2 align="center">INPUT DATA BARANG</h2>
		<?php
		    echo"<h5>Hai : " . $_SESSION['username'];
		?>
		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_7k8jk8vi.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
	</center>
	<center>
	    <div class="glass">
			<form method="POST" action="input_barang.php" enctype="multipart/form-data">
				<table>
					<tr>
						<td align="top">Nama Barang : </td>
						<td> : <input type="text" name="barang" size=30></td>
					</tr>
					<tr>
						<td>Brand : </td>
						<td> : <input type="text" name="brand" size=15></td>
					</tr>
					<tr>
						<td>Kategori : </td>
						<td>
							<select name="kategori">
								<option value=0 selected>- Pilih Kategori -</option>
								<?php
									include "../config/koneksi.php";
									$tampil = mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
									while($r = mysqli_fetch_array($tampil)){
										echo "<option value=$r[nama_kategori]>$r[nama_kategori]</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jumlah : </td>
						<td><input type="number" name="jumlah" size=15></td>
					</tr>
					<tr>
						<td>Harga : </td>
						<td><input type="number" name="harga" size=15></td>
					</tr>
					<tr>
						<td>Gambar : </td>
						<td><input type="file" name="fupload" size=40></td>
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