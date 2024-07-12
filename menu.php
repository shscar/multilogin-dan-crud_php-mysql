<?php
// ----------Cek Login ----------//
session_start();
if (empty($_SESSION['username'])) {
	header("location:index.php");
}
// -------------------------//
// Menentukan waktu saat ini
date_default_timezone_set('Asia/Jakarta');
$currentHour = date('H');

if ($currentHour >= 5 && $currentHour < 12) {
    $greeting = "Selamat Pagi";
} elseif ($currentHour >= 12 && $currentHour < 15) {
    $greeting = "Selamat Siang";
} elseif ($currentHour >= 15 && $currentHour < 18) {
    $greeting = "Selamat Sore";
} else {
    $greeting = "Selamat Malam";
}
?>
<html>
<head>
    <title>:: Menu Utama ::</title>
	<link rel="stylesheet" href="assets/css/menu.css">
</head>
<body>
    <center>
		<p align="center"><font size="12"><b>MENU UTAMA</b></font></p>
		<?php
			echo "<h5>Hallo " . $_SESSION['username'] . " " . $greeting . "</h5>";
			$user_level = $_SESSION['level'];
		?>
		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_1pxqjqps.json" background="transparent" speed="1" style="width: 400px; height: 400px;"loop autoplay></lottie-player>
	   
	   	<?php if ($user_level == 'admin') : ?>
			<button onclick="location.href='kategori/k_read.php'">Tampil Kategori</button></br></br>
		<?php endif; ?>
		<button onclick="location.href='barang/tampil_barang.php'">Tampil Barang</button></br></br>
		<button onclick="location.href='logout.php'">LogOut</button>

		<!-- <form method=POST action=form_barang.php>
				<button>Tambah Barang</button>
		</form>
		<form method=POST action=tampil_barang.php>
				<button>Tampil Barang</button>
		</form>
		<form method=POST action=logout.php>
				<button>LogOut</button>
		</form> -->
	</center>
</body>
</html>
		