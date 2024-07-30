<?php
    // Ambil semua data pada file navbar
    include('../component/navbar.php');
    if ($_SESSION['level'] = 'user') {
        header("Location: index.php");
        exit();
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];

        // Query untuk menambahkan data
        $sql = "INSERT INTO kategori (nama_kategori, keterangan) VALUES (?, ?)";
        $stmt = $konek->prepare($sql);
        $stmt->bind_param("ss", $nama_kategori, $keterangan);

        if ($stmt->execute()) {
            echo "<script>alert('Data kategori berhasil ditambahkan.');</script>";
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $konek->error;
        }

        $stmt->close();
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
                        <?php echo "Selamat " . $greeting . " " . $_SESSION['username'];?>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Tambah Kategori
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Masukkan Nama</label>
                                    <input class="form-control" type="text" name="nama_kategori" />
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan"></textarea>
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