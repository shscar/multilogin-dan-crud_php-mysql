<?php
include('../component/navbar.php');

// Ambil ID pengguna dari query string
$id_akun = $_GET['id_akun']; // Misalnya ID pengguna diambil dari query string
if (!isset($id_akun) || !is_numeric($id_akun)) {
    die("Invalid ID.");
}

// Query untuk mendapatkan nilai enum dari kolom level
$query = "SHOW COLUMNS FROM login LIKE 'level'";
$result = mysqli_query($konek, $query) or die(mysqli_error($konek));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Mendapatkan daftar nilai enum
$type = $row['Type']; // Mengambil tipe data dari kolom
preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
$enum_values = explode("','", $matches[1]);

// Ambil data pengguna yang ingin di-edit
$query_user = "SELECT username, level FROM login WHERE id_akun = ?";
$stmt_user = $konek->prepare($query_user);
$stmt_user->bind_param("i", $id_akun);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user_data = $result_user->fetch_assoc();
$stmt_user->close();

// Nilai default yang sudah dipilih sebelumnya dari database
$selected_level = $user_data['level'];

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $level = $_POST['level'];

    // Query untuk memperbarui data
    $sql = "UPDATE login SET level = ? WHERE id_akun = ?";
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("si", $level, $id_akun);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui.');</script>";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }

    $stmt->close();
    $konek->close();
}
?>

<head>
    <title>Edit User</title>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">
                        <?php echo "Selamat " . $greeting . " " . $_SESSION['username']; ?>
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Edit User
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>User</label>
                                    <input class="form-control" type="text" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" disabled />
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level">
                                        <option value="">- Pilih Level -</option>
                                        <?php
                                        foreach ($enum_values as $value) {
                                            $selected = ($value == $selected_level) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$value</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-warning" onclick="history.back();">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
