<?php
    include('../component/navbar.php');

    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file = $_FILES['fupload']['name'];
    
    // Bila yg diinput lengkap//
    if(!empty($lokasi_file)){
        move_uploaded_file($lokasi_file, "../assets/gambar/$nama_file");
        $a = mysqli_query($konek, "INSERT INTO barang (namabrg, brand, kategori, jumlah, harga, gambar)
        VALUES('$_POST[barang]', '$_POST[brand]', '$_POST[kategori]', '$_POST[jumlah]', '$_POST[harga]', '$nama_file')");

        echo"<script>
            alert('data berhasil disimpan');
            window.location='index.php';
        </script>";
    // } else {
    //     echo"
    //         <h1 align=center>Maaf, Data yang anda masukan tidak lengkap,<br>Silahkan Kembali.</h1>
    //         <button type='button' onclick='history.back();'>Kembali</button>
    //     ";
    } 

?>

    
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">FORM EXAMPLES</h4>
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
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" type="text" name="barang" />
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <input class="form-control" type="text" name="brand" />
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value=0 selected>- Pilih Kategori -</option>
                                        <?php
                                            $tampil = mysqli_query($konek, "SELECT * FROM kategori ORDER BY nama_kategori");
                                            while($r = mysqli_fetch_array($tampil)){
                                                echo "<option value=$r[nama_kategori]>$r[nama_kategori]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah" />
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input class="form-control" type="number" name="harga" />
                                </div>
                                <div class="form-group">
                                    <label>Gambar/label>
                                    <input class="form-control" type="file" name="fupload" />
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                    <button type="button" class="btn btn-warning" onclick="history.back();">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>