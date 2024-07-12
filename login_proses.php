
<?php
session_start();
include('config/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk memeriksa user
    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];

		header("location:menu.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
    $stmt->close();
    $konek->close();
}
?>
