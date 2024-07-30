<?php
    include('../component/navbar.php');
    //---------------------------------//
    if ($_SESSION['level'] != 'admin') {
        header("Location: ../component/dashboard.php");
        exit();
    }
    //---------------------------------//

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];

        // Query untuk memperbarui data
        $sql = "UPDATE kategori SET nama_kategori=?, keterangan=? WHERE id_kategori=?";
        $stmt = $konek->prepare($sql);
        $stmt->bind_param("ssi", $nama_kategori, $keterangan, $id_kategori);

        if ($stmt->execute()) {
            echo "<script>alert('Data kategori berhasil diperbarui.');</script>";
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $konek->error;
        }

        $stmt->close();
        $konek->close();
    }

    $id_kategori = $_GET['id_kategori'];
    if (!isset($id_kategori) || !is_numeric($id_kategori)) {
        die("Invalid ID.");
    }

    $edit = mysqli_query($konek, "SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
    $ket = mysqli_fetch_array($edit);

?>

<head>
    <title>Edit Kategori</title>
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
                            BASIC FORM
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="">
                                <input type="hidden" name="id_kategori" value="<?php echo htmlspecialchars($ket['id_kategori']); ?>" />
                                <div class="form-group">
                                    <label>Enter Name</label>
                                    <input class="form-control" type="text" name="nama_kategori" value="<?php echo htmlspecialchars($ket['nama_kategori']); ?>" />
                                    <p class="help-block">Help text here.</p>
                                </div>
                                <div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3" name="keterangan"><?php echo htmlspecialchars($ket['keterangan']); ?></textarea>
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
