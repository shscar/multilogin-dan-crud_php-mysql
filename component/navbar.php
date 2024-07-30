<?php
    // ----------Cek Login ----------//
    session_start();
    include('../config/koneksi.php');
    if (empty($_SESSION['username'])) {
        header("location:index.php");
    }
    // -------------------------//
    
    // Menentukan waktu saat ini
    date_default_timezone_set('Asia/Jakarta');
    $currentHour = date('H');
    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = " Pagi";
    } elseif ($currentHour >= 12 && $currentHour < 15) {
        $greeting = " Siang";
    } elseif ($currentHour >= 15 && $currentHour < 18) {
        $greeting = " Sore";
    } else {
        $greeting = " Malam";
    }

    $user_level = $_SESSION['level'];
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dhasboard</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="../assets/img/logo.png" />
                    <!-- <h1>Logo</h1> -->
                </a>
            </div>

            <div class="right-div">
                <button class="btn btn-default" onclick="location.href='../dashboard.php'">Dashboard</button>
                <button class="btn btn-default" onclick="location.href='../user.php'">User</button>
                <button class="btn btn-default" onclick="location.href='../kategori/index.php'">Kategori</button>
                <button class="btn btn-default" onclick="location.href='../barang/index.php'">Barang</button>
                <button class="btn btn-danger" onclick="location.href='../logout.php'">LOG OUT</button>
            </div>
        </div>
    </div>

	<script src="../assets/js/jquery-1.10.2.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/custom.js"></script>
</body>
</html>