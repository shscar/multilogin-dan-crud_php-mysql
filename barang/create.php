<?php
    // Ambil semua data pada file navbar
    include('../component/navbar.php');
    if ($_SESSION['level'] = 'user') {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $nama_file = $_FILES['fupload']['name'];
        $error_file = $_FILES['fupload']['error'];

        // Bila yg diinput lengkap
        if (!empty($lokasi_file) && $error_file == 0) {
            // Ambil ekstensi file
            $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);

            // Buat nama file baru dengan tanggal dan kode acak
            $tanggal = date("Ymd");
            $kode_acak = uniqid();
            $nama_file_baru = $tanggal . "_" . $kode_acak . "." . $ekstensi_file;

            // Pindahkan file ke folder tujuan
            move_uploaded_file($lokasi_file, "../assets/gambar/$nama_file_baru");

            // Simpan data ke database
            $stmt = $konek->prepare("INSERT INTO barang (namabrg, brand, kategori, jumlah, harga, gambar) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssids", $_POST['barang'], $_POST['brand'], $_POST['kategori'], $_POST['jumlah'], $_POST['harga'], $nama_file_baru);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location='index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal disimpan');
                    window.location='index.php';
                </script>";
            }

            $stmt->close();
        } else {
            echo "<h1 align=center>Maaf, Data yang anda masukan tidak lengkap,<br>Silahkan Kembali.</h1>
                <button type='button' onclick='history.back();'>Kembali</button>";
        }
    }
?>
<head>
    <title>Tambah Barang</title>
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
                            <form role="form" method="POST" action="" enctype="multipart/form-data">
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
                                        while ($r = mysqli_fetch_array($tampil)) {
                                            echo "<option value='{$r['nama_kategori']}'>{$r['nama_kategori']}</option>";
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
                                    <label>Gambar</label>
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
</body>