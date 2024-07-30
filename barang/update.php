<?php
    // Ambil semua data pada file navbar
    include('../component/navbar.php');
    if ($_SESSION['level'] = 'user') {
        header("Location: index.php");
        exit();
    }

    $id = $_GET['id'];
    if (!isset($id) || !is_numeric($id)) {
        die("Invalid ID.");
    }

    $edit  = mysqli_query($konek, "SELECT * FROM barang WHERE idbarang='$id'");
    $row   = mysqli_fetch_array($edit);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $nama_file = $_FILES['fupload']['name'];
        $error_file = $_FILES['fupload']['error'];

        // Apabila Gambar Tidak Diganti
        if (empty($lokasi_file)) {
            $query = "UPDATE barang SET namabrg = ?, brand = ?, kategori = ?, jumlah = ?, harga = ? WHERE idbarang = ?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("sssidi", $_POST['barang'], $_POST['brand'], $_POST['kategori'], $_POST['jumlah'], $_POST['harga'], $_POST['id']);
            
            if ($stmt->execute()) {
                echo "<script>
                    alert('Data berhasil diperbarui');
                    window.location='index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diperbarui');
                    window.location='index.php';
                </script>";
            }

            $stmt->close();
        } 
        
        // Apabila Gambar Diganti
        else {
            // Ambil ekstensi file
            $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);

            // Buat nama file baru dengan tanggal dan kode acak
            $tanggal = date("Ymd");
            $kode_acak = uniqid();
            $nama_file_baru = $tanggal . "_" . $kode_acak . "." . $ekstensi_file;

            // Ambil nama file gambar lama dari database
            $query = "SELECT gambar FROM barang WHERE idbarang = ?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("i", $_POST['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $gambar_lama = $row['gambar'];
            $stmt->close();

            // Pindahkan file baru ke folder tujuan
            if (move_uploaded_file($lokasi_file, "../assets/gambar/$nama_file_baru")) {
                // Hapus file gambar lama
                if (!empty($gambar_lama) && file_exists("../assets/gambar/$gambar_lama")) {
                    unlink("../assets/gambar/$gambar_lama");
                }

                // Simpan data ke database
                $query = "UPDATE barang SET namabrg = ?, brand = ?, kategori = ?, jumlah = ?, harga = ?, gambar = ? WHERE idbarang = ?";
                $stmt = $konek->prepare($query);
                $stmt->bind_param("sssidsi", $_POST['barang'], $_POST['brand'], $_POST['kategori'], $_POST['jumlah'], $_POST['harga'], $nama_file_baru, $_POST['id']);
                
                if ($stmt->execute()) {
                    echo "<script>
                        alert('Data berhasil diperbarui');
                        window.location='index.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('Data gagal diperbarui');
                        window.location='index.php';
                    </script>";
                }

                $stmt->close();
            } else {
                echo "<script>
                    alert('Gagal mengupload gambar baru');
                    window.location='index.php';
                </script>";
            }
        }
        $konek->close();
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
                                    <img src="../assets/gambar/<?php echo htmlspecialchars($row['gambar']); ?>" width="auto" height="200">
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