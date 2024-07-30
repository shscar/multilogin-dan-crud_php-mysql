
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
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, level) VALUES ('$username', '$password', '$level')";

    // Execute
    if (mysqli_query($konek, $sql)) {
        echo "<script>alert('Registration successful!.');</script>";
        header("Location: component/dashboard.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
    mysqli_close($konek);
}
?>
