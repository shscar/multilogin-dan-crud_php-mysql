<?php
$server = "localhost";
$username = "debian-sys-maint";
$password = "utZ4OvZujbtPHWiB";
$database = "pro_fikskom";

$konek = mysqli_connect($server, $username, $password) or die ("koneksi Gagal!");
mysqli_select_db($konek, $database) or die ("Database tidak bisa dibuka");

function query($sql){
	global $konek;
	$result = mysqli_query($konek, $sql);
	
	$rows=[];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row; 
	}
	return $rows;
}

function hapus($id) {
	global $konek;
	mysqli_query($konek, "DELETE FROM barang WHERE idbarang = $id");
	
	return mysqli_affected_rows($konek);
}

// function cari($keyword){
// 	$query = "SELECT * FROM barang WHERE
// 		namabrg LIKE '%$keyword%' OR
// 		brand LIKE '%$keyword%' OR
// 		katagori LIKE '%$keyword%' OR
// 		jumlah LIKE '%$keyword%' OR
// 		harga LIKE '%$keyword%' OR
// 	";
// 	return query($query);
// }

function cari($keyword){
    // Menggunakan prepared statements untuk mencegah SQL Injection
    global $konek;
    $keyword = "%$keyword%";
    $stmt = $konek->prepare("SELECT * FROM barang WHERE namabrg LIKE ? OR brand LIKE ? OR kategori LIKE ?");
    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
    $stmt->execute();
    return $stmt->get_result();
}