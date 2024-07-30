<?php
include('../component/navbar.php');

$id = $_GET['id'];
if (!isset($id) || !is_numeric($id)) {
    die("Invalid ID.");
}

$edit  = mysqli_query($konek, "SELECT * FROM barang WHERE idbarang='$id'");
$row   = mysqli_fetch_array($edit);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file = $_FILES['fupload']['name'];
    
    //Apabila Gambar Tidak Diganti
    if (empty($lokasi_file)){
        mysqli_query($konek,"UPDATE barang SET namabrg ='$_POST[barang]',brand ='$_POST[brand]',kategori ='$_POST[kategori]',jumlah ='$_POST[jumlah]',harga ='$_POST[harga]' WHERE idbarang ='$_POST[id]'");
    }
    
    //Apabila Gambar Diganti
    else{
        move_uploaded_file($lokasi_file,"../assets/gambar/$nama_file");
        mysqli_query($konek,"UPDATE barang SET namabrg ='$_POST[barang]', brand ='$_POST[brand]', kategori ='$_POST[kategori]', jumlah ='$_POST[jumlah]', harga ='$_POST[harga]', gambar ='$nama_file' WHERE idbarang ='$_POST[id]'");
    }
    
    header('location:index.php');
}
?>
<head>
    <title>Tambah Kategori</title>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">
                        <?php echo "Selamat " . $greeting . " " . $_SESSION['username']; ?>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Tambah Barang
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="#" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['idbarang']); ?>">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" type="text" name="barang" value="<?php echo htmlspecialchars($row['namabrg']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <input class="form-control" type="text" name="brand" value="<?php echo htmlspecialchars($row['brand']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <?php $tampil = mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
                                        while ($c = mysqli_fetch_array($tampil)) {
                                            $selected = ($row['id_kategori'] == $c['id_kategori']) ? 'selected' : '';
                                            echo "<option value='" . htmlspecialchars($c['id_kategori']) . "' $selected>" . htmlspecialchars($c['nama_kategori']) . "</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah" value="<?php echo htmlspecialchars($row['jumlah']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input class="form-control" type="number" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label></br>
                                    <img src="../assets/gambar/<?php echo htmlspecialchars($row['gambar']); ?>" width="250" height="200">
                                    <input class="form-control" type="file" name="fupload" />
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-warning" onclick="history.back();">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>