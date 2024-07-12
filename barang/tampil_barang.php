<?php
	//------------------------//
	session_start();
	if (empty($_SESSION['username'])) {
		header("location:index.php");
		exit(); 
	}
	//-------------------------//
	
	require '../config/koneksi.php';
	$barang = query("SELECT * FROM barang");
	$user_level = $_SESSION['level'];

	// kolom pencarian terisi
	if(isset($_POST["cari"]) ) {
		$barang = cari($_POST["keyword"]);
	}
?>
<html>
<head>
<title>Inventory Gudang</title>
	<link rel="stylesheet" href="../assets/css/tbarang.css">
	<!-- datatable style -->
	<link rel="stylesheet" type="text/css" href="https://cdn.database.net/1.10.20/css/jquery.dataTables.css">
	
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-1.11-0.min.js"></script>
	
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
	<h2 align=center>DAFTAR BARANG</h2>
	<center>
		<table>
			<?php if ($user_level == 'admin') : ?>
				<button onclick="location.href='form_barang.php'">Tambah Barang</button>
			<?php endif; ?>
			<button onclick="location.href='../menu.php'">Menu</button>
			<button onclick="location.href='../logout.php'">LogOut</button>

		</table>
		<br>
		<form action="" method="POST">
			<input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian.." autocomplete="off" id="keyword">
			<button type="submit" name="cari">Cari</button>
		</form>
		<div id="container">
			<table class="styled-table" border=0 >
				<tr class="judul">
					<th>No</th>
					<th>Nama Barang</th>
					<th>Brand</th>
					<th>Kategori</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Gambar</th>
					<th>Action</th>
				</tr>
				
				<?php $i = 1; ?>
				<?php foreach($barang as $row ){ ?>
				<tr class="isi">
					<td align=center><?= $i; ?></td>
					<td align=left><?= $row["namabrg"] ?></td>
					<td align=left><?= $row["brand"] ?></td>
					<td align=left><?= $row["kategori"] ?></td>
					<td align=center><?= $row["jumlah"] ?></td>
					<td align=left>Rp. <?= $row["harga"] ?></td>
					<td align=center><img src="gambar/<?= $row["gambar"]; ?>" width="70" height="70"></td>
					<td class='action-links'>
						<a href="edit_barang.php?id=<?php echo $row['idbarang']; ?>">Edit</a> <span>|</span>
						<?php if ($user_level == 'admin') : ?>
							<a href="hapus_barang.php?id=<? echo $row['idbarang']; ?>" onclick="return confirm('yakin ingin menghapus data ini ?')">Hapus</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php $i++;
			} ?>
			</table>
		</div>
	</center>
	<script src="assets/js/cari.js"></script>
</body>
</html>