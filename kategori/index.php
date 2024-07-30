<?php
    include('../component/navbar.php');

	$kategori = query("SELECT * FROM kategori");

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
                            Kategori
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($kategori as $ket ){ ?>
                                        <tr class="odd grade">
                                            <td class="center"><?= $i; ?></td>
                                            <td><?= $ket["nama_kategori"] ?></td>
                                            <td><?= $ket["keterangan"] ?></td>
                                            <td class='action-links'>
                                                <a href="update.php?id_kategori=<?php echo $ket['id_kategori']; ?>">Edit</a> <span>|</span>
                                                
                                                <?php if ($user_level == 'admin') : ?>
                                                    <a href="k_delete.php?id=<? echo $ket['id_kategori']; ?>" onclick="return confirm('yakin ingin menghapus data ini ?')">Hapus</a>
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