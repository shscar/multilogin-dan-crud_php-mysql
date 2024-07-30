<?php
    include('component/navbar.php');
?>

    <!-- <center>
		<p align="center"><font size="12"><b>MENU UTAMA</b></font></p>
		<?php
			echo "<h5>Hallo " . $_SESSION['username'] . " " . $greeting . "</h5>";
			
		?>
		<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
		<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_1pxqjqps.json" background="transparent" speed="1" style="width: 400px; height: 400px;"loop autoplay></lottie-player>
	   
	   	<?php if ($user_level == 'admin') : ?>
			<button onclick="location.href='kategori/k_read.php'">Tampil Kategori</button></br></br>
		<?php endif; ?>
		<button onclick="location.href='barang/tampil_barang.php'">Tampil Barang</button></br></br>
		<button onclick="location.href='logout.php'">LogOut</button>

	</center> -->

<!DOCTYPE html>

<head>
</head>

<body>
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
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-user fa-5x"></i>
                        <h3>500+&nbsp; <i class="fa fa-dollar"></i></h3>
                        Amount Pending For Approval
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-bars fa-5x"></i>
                        <h3>300+ Tasks</h3>
                        Pending For New Events
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-warning back-widget-set text-center">
                        <i class="fa fa-recycle fa-5x"></i>
                        <h3>56+ Calls</h3>
                        To Be Made For New Orders
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-danger back-widget-set text-center">
                        <i class="fa fa-briefcase fa-5x"></i>
                        <h3>30+ Issues </h3>
                        That Should Be Resolved Now
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>