<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role_id = 1; // Set role_id sebagai pengguna (1)

    // Simpan data pengguna baru
    $stmt = $conn->prepare("INSERT INTO Users (username, password, email, nomor_telepon, role_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $username, $hashed_password, $email, $nomor_telepon, $role_id);

    if ($stmt->execute()) {
        echo "Pengguna berhasil ditambahkan!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menambah pengguna!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f2;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            background-color: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        .card-body {
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #ff66b3;
            margin-bottom: 30px;
        }
        .form-label {
            font-size: 1rem;
            color: #ff66b3;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ff66b3;
            background-color: #f9e6f0;
        }
        .form-control:focus {
            border-color: #ff4da6;
            box-shadow: 0 0 5px rgba(255, 77, 166, 0.5);
        }
        .btn-primary {
            background-color: #ff66b3;
            border-color: #ff66b3;
            border-radius: 8px;
            padding: 10px;
        }
        .btn-primary:hover {
            background-color: #ff4da6;
            border-color: #ff4da6;
        }
        .btn {
            font-size: 1.1rem;
        }
        .container {
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card form-container">
            <div class="card-body">
                <h2>Tambah Data Pengguna</h2>
                <form action="admin_add_user.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
