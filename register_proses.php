<?php
session_start();
include('config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cf_password = $_POST['cf_password'];
    $level = 'user'; // Automatically set level ke 'user'
    
    // Validate form data
    if (empty($username) || empty($password) || empty($cf_password)) {
        echo "<script>
            alert('form tidak diisi dengan benar');
            window.location='index.php';
        </script>";
        exit;
    }

    // Check if passwords match
    if ($password !== $cf_password) {
        echo "<script>
            alert('passwords match');
            window.location='index.php';
        </script>";
        exit;
    }

    // Hash password (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO login (username, password, level) VALUES (?, ?, ?)";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $level);

    // Execute
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;
        header("Location: component/dashboard.php");
        exit();
    } else {
		echo "<script type='text/JavaScript'>
                alert('Silahkan Masukan username dan password dengan benar');
                window.location='index.php';
            </script>
		";
        exit();
    }

    $stmt->close();
    $konek->close();
}
?>
