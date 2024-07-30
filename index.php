<?php
if (isset($_GET['pesan'])) {
	//cek apakah login benar / salah
	if ($_GET['pesan'] == "gagal") {
		echo '<script type="text/JavaScript">
					alert("Silahkan Masukan username dan password dengan benar")
				</script>
			';
	}
}
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>data</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>
	<section class="menu-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="navbar-collapse collapse d-flex justify-content-between align-items-center">
						<ul id="menu-top" class="nav navbar-nav">
							<li><a href="index.html" class="menu-top-active">Welcome</a></li>
							<li><a href="#">Dashboard</a></li>
						</ul>
						<div class="right-div">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Form Login -->
	<div id="loginModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Login</h4>
				</div>
				<div class="modal-body">
					<form action="login_proses.php" method="post" name="login">
						<div class="form-group">
							<label for="username">Username:</label>
							<input type="name" class="form-control" id="username" name="username" required>
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
				<div class="modal-footer">
					<p>Belum memiliki akun? <a href="#" data-toggle="modal" data-target="#registerModal"
							data-dismiss="modal">Register here</a></p>
				</div>
			</div>
		</div>
	</div>

	<!-- Form Register -->
	<div id="registerModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Register</h4>
				</div>
				<div class="modal-body">
					<form action="register_proses.php" method="post">
						<div class="form-group">
							<label for="reg-username">username:</label>
							<input type="name" class="form-control" id="reg-username" name="username" required>
						</div>
						<div class="form-group">
							<label for="reg-password">Password:</label>
							<input type="password" class="form-control" id="reg-password" name="password" required>
						</div>
						<div class="form-group">
							<label for="confirm-password">Confirm Password:</label>
							<input type="password" class="form-control" id="confirm-password" name="cf_password"
								required>
						</div>
						<button type="submit" class="btn btn-primary">Register</button>
					</form>
				</div>
				<div class="modal-footer">
					<p>Sudah memiliki akun? <a href="#" data-toggle="modal" data-target="#loginModal"
							data-dismiss="modal">Login</a></p>
				</div>
			</div>
		</div>
	</div>

	<!-- MENU SECTION END-->
	<div class="content-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel">

						<div class="carousel-inner">
							<div class="item active">

								<img src="assets/img/1.jpg" alt="" />

							</div>
							<div class="item">
								<img src="assets/img/2.jpg" alt="" />

							</div>
							<div class="item">
								<img src="assets/img/3.jpg" alt="" />

							</div>
						</div>
						<!--INDICATORS-->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example" data-slide-to="1"></li>
							<li data-target="#carousel-example" data-slide-to="2"></li>
						</ol>
						<!--PREVIUS-NEXT BUTTONS-->
						<a class="left carousel-control" href="#carousel-example" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
				</div>


				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="alert alert-info text-center">
						<h3> IMPORTANT NOTICE</h3>
						<hr />
						<i class="fa fa-warning fa-4x"></i>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
							Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
							Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
							Lorem ipsum dolor sit amet.
						</p>
						<hr />
						<a href="#" class="btn btn-info">Read Full Detalis</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- CONTENT-FOOTER -->
	<section class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					&copy; 2024 shscar |<a href="https://shscar.git" target="_blank"> Designed by : shscar.git</a>
				</div>

			</div>
		</div>
	</section>
	
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const inputs = document.querySelectorAll('.form__input');

			function addFocus() {
				let parent = this.parentNode.parentNode;
				parent.classList.add('focus');
			}

			function removeFocus() {
				let parent = this.parentNode.parentNode;
				if (this.value === '') {
					parent.classList.remove('focus');
				}
			}

			inputs.forEach(input => {
				input.addEventListener('focus', addFocus);
				input.addEventListener('blur', removeFocus);
			});
		});

	</script>

</body>

</html>