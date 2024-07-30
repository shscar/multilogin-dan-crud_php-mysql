<?php
    // Ambil semua data pada file navbar
    include('navbar.php');

// Query untuk menghitung total user
$query_user = "SELECT COUNT(*) as total_user FROM login";
$result_user = mysqli_query($konek, $query_user);
$data_user = mysqli_fetch_assoc($result_user);
$total_user = $data_user['total_user'];

// Query untuk menghitung total kategori
$query_kategori = "SELECT COUNT(*) as total_kategori FROM kategori";
$result_kategori = mysqli_query($konek, $query_kategori);
$data_kategori = mysqli_fetch_assoc($result_kategori);
$total_kategori = $data_kategori['total_kategori'];

// Query untuk menghitung total barang
$query_barang = "SELECT COUNT(*) as total_barang FROM barang";
$result_barang = mysqli_query($konek, $query_barang);
$data_barang = mysqli_fetch_assoc($result_barang);
$total_barang = $data_barang['total_barang'];
?>

<head>
    <title>Dhasboard</title>
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
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-user fa-5x"></i>
                        <h3><?php echo $total_user; ?>+ User</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-danger back-widget-set text-center">
                        <i class="fa fa-briefcase fa-5x"></i>
                        <h3><?php echo $total_kategori; ?>+ Kategori </h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-bars fa-5x"></i>
                        <h3><?php echo $total_barang; ?>+ Data</h3>
                    </div>
                </div>
                <!-- <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-warning back-widget-set text-center">
                        <i class="fa fa-recycle fa-5x"></i>
                        <h3>56+ </h3>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>
