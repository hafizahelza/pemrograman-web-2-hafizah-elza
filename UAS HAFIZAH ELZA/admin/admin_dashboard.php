<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ubah nama kolom id menjadi user_id atau nama kolom yang benar
$sql = "SELECT user_id, username, email, nomor_telepon FROM Users WHERE role_id != 2"; // Menampilkan pengguna non-admin
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tema Pink Gradasi */
        body {
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4, #ffdde1);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #e91e63;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .action-bar form {
            flex-grow: 1;
            margin-left: 20px;
        }

        .action-bar form input {
            border-radius: 30px;
            padding: 10px 15px;
            border: 1px solid #f06292;
            width: calc(100% - 120px);
        }

        .action-bar form button {
            background-color: #f06292;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            margin-left: 10px;
        }

        .action-bar .btn-primary {
            background-color: #e91e63;
            border-color: #d81b60;
            padding: 10px 20px;
            border-radius: 30px;
        }

        .action-bar .btn-primary:hover {
            background-color: #d81b60;
            border-color: #c2185b;
        }

        .table {
            margin-top: 20px;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .table th {
            background-color: #f06292;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .btn {
            border-radius: 20px;
            font-size: 14px;
        }

        .btn-warning {
            background-color: #fbc02d;
            border-color: #f9a825;
        }

        .btn-warning:hover {
            background-color: #f9a825;
        }

        .btn-info {
            background-color: #29b6f6;
            border-color: #0288d1;
        }

        .btn-info:hover {
            background-color: #0288d1;
        }

        .btn-danger {
            background-color: #e53935;
            border-color: #d32f2f;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard Admin</h2>
        
        <div class="action-bar">
            <a href="admin_add_user.php" class="btn btn-primary">Tambah Data</a>
            <form action="admin_dashboard.php" method="GET">
                <input type="text" name="search" placeholder="Cari pengguna berdasarkan nama atau email">
                <button type="submit">Cari</button>
            </form>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT user_id, username, email, nomor_telepon FROM Users WHERE (username LIKE ? OR email LIKE ?) AND role_id != 2";
                    $stmt = $conn->prepare($sql);
                    $search_term = "%$search%";
                    $stmt->bind_param("ss", $search_term, $search_term);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }

                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['nomor_telepon']); ?></td>
                        <td>
                            <a href="admin_edit_user.php?id=<?= $row['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="admin_delete_user.php?id=<?= $row['user_id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                            <a href="admin_view_user.php?id=<?= $row['user_id']; ?>" class="btn btn-info btn-sm">Lihat Detail Data</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Tombol Logout di pojok bawah -->
    <a href="admin_login.php" class="btn btn-danger logout-btn">Logout</a>
</body>
</html>

<?php
$conn->close();
?>
