<?php
    if(isset($_GET['pesan'])) {
		//cek apakah login benar / salah
		if($_GET['pesan'] == "gagal"){
			echo '<script type="text/JavaScript">
					alert("Silahkan Masukan username dan password dengan benar")
				</script>
			';
		}
	}
?>
<html>
<head>
	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="assets/css/styles.css">
	
	<!-- ==== BOX ICONS ONLINE==== -->
	<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	
	<!-- ==== JAVASCRIPT ABIMASI ==== -->
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	
	<title>Login</title>
</head>
<body>
	    <div class="1-form">
		<div class="shape1"></div>
		<div class="shape2"></div>
		<div class="form">
			<lottie-player class="form__img" src="https://assets5.lottiefiles.com/packages/lf20_mrmg8x7w.json" background="transparent" speed=1 syle="width: 500px; height: 500px:" loop autoplay></lottie-player>
			
			<form id="login" method="post" name="login" action="login_proses.php" class="form__content">
				<h1 class="form__title">Welcome</h1>
				
				<div class="form__div form__div-one">
					<div class="form__icon">
						<i class='bx bx-user-circle'></i>
					</div>
				
					<div class="form__div-input">
						<label for="" class="form__label">Username</label>
						<input name="username" type="text" class="form__input" id="username">
					</div>
				</div>
				
				<div class="form__div">
					<div class="form__icon">
						<i class='bx bx-lock' ></i>
					</div>
					
					<div class="form__div-input">
						<label for="" class="form__label">Password</label>
						<input name="password" type="password" class="form__input" id="password">
					</div>
				</div>

					<a href="./register.php">Belum memiliki akun..</a></br></br>
					<input name="login "type="submit" class="form__button" id="login" value="Login">
			</form>
		</div>
	</div>
	<!-- ==== MAIN JS ==== -->
	<script src="assets/js/main.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
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