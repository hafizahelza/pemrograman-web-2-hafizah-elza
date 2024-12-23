<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$error_message = "";

// Proses form registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validasi input tidak kosong
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "Semua kolom wajib diisi!";
    } elseif ($password !== $confirm_password) {
        // Cek password dan konfirmasi password
        $error_message = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username atau email sudah ada
        $sql = "SELECT user_id FROM Users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "Username atau email sudah terdaftar!";
        } else {
            // Enkripsi password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan data ke dalam tabel Users dengan role_id = 1 (pimpinan)
            $role_id = 1; // Role 1 untuk pimpinan
            $stmt = $conn->prepare("INSERT INTO Users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $email, $hashed_password, $role_id);

            if ($stmt->execute()) {
                echo "Registrasi berhasil! Anda dapat <a href='login_pimpinan.php'>login</a> sekarang.";
            } else {
                $error_message = "Terjadi kesalahan, coba lagi. Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #ffdde1, #fbc2eb);
            background-size: 400% 400%;
            animation: gradientBG 8s ease infinite;
            color: #333;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #ff6b9d;
            font-weight: 600;
        }

        .btn-pink {
            background: linear-gradient(135deg, #ff6b9d, #ff4b87);
            border: none;
            color: white;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 12px;
        }

        .btn-pink:hover {
            background: linear-gradient(135deg, #ff4b87, #ff3366);
            box-shadow: 0 4px 10px rgba(255, 75, 135, 0.3);
        }

        .form-control {
            border-radius: 25px;
            padding: 12px;
            border: none;
            background-color: #f9f9f9;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            background: #fff;
            box-shadow: 0px 4px 8px rgba(255, 107, 157, 0.2);
            outline: none;
        }

        .text-link {
            color: #ff6b9d;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .text-link:hover {
            color: #ff4b87;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Register Pimpinan</h2>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form action="register_pimpinan.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password" required>
                </div>
                <button type="submit" class="btn btn-pink w-100">Daftar</button>
            </form>

            <p class="text-center mt-3">Sudah memiliki akun? <a href="login_pimpinan.php" class="text-link">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
