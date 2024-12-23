<?php
session_start();

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

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah tabel memiliki kolom 'id', sesuaikan jika perlu
    $stmt = $conn->prepare("SELECT user_id, password, role_id FROM Users WHERE username = ? AND role_id = 2");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['user_id'];  // Simpan ID admin dalam sesi
            header("Location: admin_dashboard.php");  // Halaman dashboard admin
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan atau Anda bukan admin!";
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
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background gradient for pink theme */
        body {
            background: linear-gradient(to bottom right, #ff9a9e, #fad0c4, #ffdde1);
            font-family: 'Poppins', sans-serif;
            color: #333;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #ff4b87;
            font-weight: bold;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 30px;
            border: 1px solid #ffc1e3;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff4b87;
            box-shadow: 0 0 10px rgba(255, 75, 135, 0.2);
        }

        .btn-primary {
            background-color: #ff4b87;
            border-color: #ff4b87;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff3372;
            border-color: #ff3372;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        p {
            margin-top: 15px;
            color: #666;
            font-size: 14px;
        }

        .link-text {
            color: #ff4b87;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .link-text:hover {
            color: #ff3372;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Admin</h2>
        <form action="admin_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p>Belum memiliki akun? <a href="admin_register.php" class="link-text">Daftar di sini</a></p>
    </div>
</body>
</html>
