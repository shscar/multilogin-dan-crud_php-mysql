<?php
    // Ambil semua data pada file navbar
    include('../component/navbar.php');

	$barang = query("SELECT * FROM barang");
?>

<head>
    <title>Data Barang</title>
</head>
<body>
    <!-- SECTION -->
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
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Barang
                            <button type="button" onclick="location.href='create.php'" class="btn btn-primary btn-sm" style="float: right;">Tambah</button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Brand</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($barang as $row ){ ?>
                                        <tr class="odd grade">
                                            <td class="text-center"><?= $i; ?>.</td>
                                            <td><?= $row["namabrg"] ?></td>
                                            <td><?= $row["brand"] ?></td>
                                            <td><?= $row["kategori"] ?></td>
                                            <td class="text-center"><?= $row["jumlah"] ?></td>
                                            <td>Rp. <?= $row["harga"] ?></td>
                                            <td class="text-center"><img src="../assets/gambar/<?= $row["gambar"]; ?>" width="auto" height="50px"></td>
                                            <td class='action-links'>
                                                <?php if ($user_level != 'user') : ?>
                                                    <a class="btn btn-warning" href="update.php?id=<?php echo $row['idbarang']; ?>">Edit</a>
                                                    <span>|</span>
                                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['idbarang']; ?>" onclick="return confirm('yakin ingin menghapus data ini ?')">Hapus</a>
                                                <?php else: ?>
                                                    <span>-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++;} ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>