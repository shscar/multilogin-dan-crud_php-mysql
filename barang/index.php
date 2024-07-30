<?php
    include('../component/navbar.php');

	$barang = query("SELECT * FROM barang");
	$user_level = $_SESSION['level'];

	// kolom pencarian terisi
	if(isset($_POST["cari"]) ) {
		$barang = cari($_POST["keyword"]);
	}
?>

    <!-- SECTION -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">
						<?php
						echo "Selamat " . $greeting . " " . $_SESSION['username'];
						?>
					</h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Barang

                            <button onclick="location.href='create.php'" class="btn btn-success">Tambah</button>
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
                                            <td class="center"><?= $i; ?></td>
                                            <td><?= $row["namabrg"] ?></td>
                                            <td><?= $row["brand"] ?></td>
                                            <td><?= $row["kategori"] ?></td>
                                            <td class="center"><?= $row["jumlah"] ?></td>
                                            <td>Rp. <?= $row["harga"] ?></td>
                                            <td class="center"><img src="../assets/gambar/<?= $row["gambar"]; ?>" width="70" height="70"></td>
                                            <td class='action-links'>
                                                <a href="edit_barang.php?id=<?php echo $row['idbarang']; ?>">Edit</a> <span>|</span>

                                                <?php if ($user_level == 'admin') : ?>
                                                    <a href="hapus_barang.php?id=<? echo $row['idbarang']; ?>" onclick="return confirm('yakin ingin menghapus data ini ?')">Hapus</a>
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