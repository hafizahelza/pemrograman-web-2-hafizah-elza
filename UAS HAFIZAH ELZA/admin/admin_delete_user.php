<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Konfigurasi database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses jika ada ID pengguna yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Ambil data pengguna berdasarkan ID
    $stmt = $conn->prepare("SELECT username FROM Users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Validasi jika pengguna ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Pengguna tidak ditemukan.";
        exit();
    }
} else {
    echo "ID pengguna tidak diberikan.";
    exit();
}

// Proses konfirmasi hapus
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $stmt = $conn->prepare("DELETE FROM Users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?status=deleted");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus pengguna.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #e91e63;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        .btn {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-danger {
            background-color: #ff4b5c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #e63946;
        }

        .btn-secondary {
            background-color: #adb5bd;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #868e96;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Konfirmasi Hapus Pengguna</h2>
        <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>

        <form method="POST">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Hapus</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
