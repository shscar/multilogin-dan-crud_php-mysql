<?php 
//-------------------Cek Login-----------------
session_start();
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'pegawai')) {
	header("Location: menu.php");
	exit(); 
}
//---------------------------------//
include "../config/koneksi.php";
?>
<html>
<head>
    <title> :: Input Barang ::</title>
	<link rel="stylesheet" href="../assets/css/ibarang.css">
</head>

<body>
	<center>
		<script src="https://unpkg.com//@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_qlwqp9xi.json" background="transparent" speed="1" style="width: 420px; height: 420px;" loop autoplay></lottie-player>
	</center>
  
	<?php
		$lokasi_file = $_FILES['fupload']['tmp_name'];
		$nama_file = $_FILES['fupload']['name'];
		
		// Bila yg diinput lengkap//
		if(!empty($lokasi_file)){
			move_uploaded_file($lokasi_file, "gambar/$nama_file");
		$a = mysqli_query($konek, "INSERT INTO barang (namabrg, brand, kategori, jumlah, harga, gambar)
		VALUES('$_POST[barang]', '$_POST[brand]', '$_POST[kategori]', '$_POST[jumlah]', '$_POST[harga]', '$nama_file')");

		echo"<script>
			alert('data berhasil disimpan');
			window.location='tampil_barang.php';
		</script>";
	} else {
		echo"
			<h1 align=center>Maaf, Data yang anda masukan tidak lengkap,<br>Silahkan Kembali.</h1>
			<button type='button' onclick='history.back();'>Kembali</button>
		";
	} ?>
</body>
</html>