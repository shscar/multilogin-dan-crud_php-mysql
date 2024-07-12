<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <title>Register</title>
</head>
<body>
	    <div class="1-form">
		<div class="shape1"></div>
		<div class="shape2"></div>
		<div class="form">
			<lottie-player class="form__img" src="https://assets5.lottiefiles.com/packages/lf20_mrmg8x7w.json" background="transparent" speed=1 syle="width: 500px; height: 500px:" loop autoplay></lottie-player>
			
    <form action="#" method="post" class="form__content">
        <h1 class="form__title">Register</h1>

        <div class="form__div form__div-one">
            <div class="form__icon">
                <i class='bx bx-user-circle'></i>
            </div>
            <div class="form__div-input">
                <label for="username" class="form__label">Username:</label>
                <input name="username" type="text" class="form__input" id="username" required>
            </div>
        </div>

        <div class="form__div form__div-one">
            <div class="form__icon">
                <i class='bx bx-lock' ></i>
            </div>
            <div class="form__div-input">
                <label for="password" class="form__label">Password:</label>
                <input name="password" type="password" class="form__input" id="password" required>
            </div>
        </div>

        <div class="form__div">
            <div class="form__icon">
                <i class='bx bx-lock' ></i>
            </div>
            <div class="form__div-input">
                <label for="cf_password" class="form__label">Confirm Password:</label>
                <input name="cf_password" type="password" class="form__input" id="password">
            </div>
        </div>

        <a href="./index.php">Sudah memiliki akun..</a></br></br>
		<input name="register" type="submit" class="form__button" id="register" value="Register">
    </form>

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

<?php
include('config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cf_password = $_POST['cf_password'];
    $level = 'user'; // Automatically set level ke 'user'
    
    // Validate form data
    if (empty($username) || empty($password) || empty($cf_password)) {
        echo "All fields are required.";
        exit;
    }

    // Check if passwords match
    if ($password !== $cf_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash password (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, level) VALUES ('$username', '$hashed_password', '$level')";

    // Execute
    if (mysqli_query($konek, $sql)) {
        echo "<script>alert('Registration successful!.');</script>";
        header("Location: menu.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($konek);
    }
    mysqli_close($konek);
}
?>
