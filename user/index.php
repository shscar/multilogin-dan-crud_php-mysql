<?php
    include('../component/navbar.php');
    
	$user = query("SELECT * FROM login");
?>

<head>
    <title>Data User</title>
</head>

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
            <?php foreach($user as $usr ){ ?>
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-body text-center">
                                <img class="img-top" src="../assets/img/" width="150px" height="auto"/>
                            </div>
                            <p>Nama: <?= $usr["username"] ?></p>
                            <p>Level: <?= $usr["level"] ?></p>
                            <a class="btn btn-warning" href="edit.php?id_akun=<?php echo $usr['id_akun'];?>">Ubah</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>