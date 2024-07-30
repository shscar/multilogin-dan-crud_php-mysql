<?php
session_start();
include('config/koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE username = ?";
$stmt = $konek->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    // Ambil data user
    $hashed_password = $user['password'];
    $level = $user['level'];

    // Verifikasi password
    if (password_verify($password, $hashed_password)) {
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
} else {
    // User tidak ditemukan
    echo "User tidak ditemukan.";
    exit();
}

$stmt->close();
$konek->close();
?>
