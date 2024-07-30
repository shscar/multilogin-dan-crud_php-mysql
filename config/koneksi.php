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

    // Ambil nama file gambar yang terkait dengan entri
    $query = "SELECT gambar FROM barang WHERE idbarang = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $gambar_lama = $row['gambar'];
    $stmt->close();

    // Hapus entri dari database
    $query = "DELETE FROM barang WHERE idbarang = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    // Jika entri berhasil dihapus, hapus gambar dari folder
    if ($affected_rows > 0) {
        if (!empty($gambar_lama) && file_exists("../assets/gambar/$gambar_lama")) {
            unlink("../assets/gambar/$gambar_lama");
        }
        return true;
    } else {
        return false;
    }
}

function hapus_k($id_kategori) {
	global $konek;
	mysqli_query($konek, "DELETE FROM kategori WHERE id_kategori = $id_kategori");
	
	return mysqli_affected_rows($konek);
}
