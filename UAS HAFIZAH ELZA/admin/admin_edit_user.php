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

// Ambil data pengguna yang ingin diedit jika id tersedia di URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id']; // Gunakan 'user_id' jika itu nama kolom yang benar
    $sql = "SELECT username, email, nomor_telepon FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika pengguna ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "Pengguna tidak ditemukan!";
        exit();
    }
}

// Update data pengguna jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Pastikan data tidak kosong
    if (!empty($username) && !empty($email) && !empty($nomor_telepon)) {
        $sql = "UPDATE Users SET username = ?, email = ?, nomor_telepon = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $nomor_telepon, $user_id);

        if ($stmt->execute()) {
            // Redirect ke halaman dashboard setelah berhasil update
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat memperbarui data!";
        }
    } else {
        echo "Semua field harus diisi!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffcccc, #ffe6f7);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            color: #ff66b3;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #ff66b3;
            border-color: #ff66b3;
        }

        .btn-primary:hover {
            background-color: #ff4da6;
            border-color: #ff4da6;
        }

        .btn-secondary {
            background-color: #e6e6e6;
            border-color: #e6e6e6;
            color: #666;
        }

        .btn-secondary:hover {
            background-color: #d9d9d9;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Pengguna</h2>
        <form action="admin_edit_user.php?id=<?= htmlspecialchars($user_id); ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= htmlspecialchars($user['nomor_telepon']); ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
