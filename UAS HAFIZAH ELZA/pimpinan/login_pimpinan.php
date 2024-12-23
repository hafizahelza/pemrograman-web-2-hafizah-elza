<?php
session_start();

// Cek jika user sudah login
if (isset($_SESSION['pimpinan_id'])) {
    header("Location: dashboard_pimpinan.php");
    exit();
}

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

// Proses form login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input tidak kosong
    if (empty($username) || empty($password)) {
        $error_message = "Username dan password wajib diisi!";
    } else {
        // Query untuk login pimpinan (role_id = 1)
        $sql = "SELECT user_id, username, password FROM Users WHERE username = ? AND role_id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['pimpinan_id'] = $user['user_id'];
                $_SESSION['pimpinan_username'] = $user['username'];
                header("Location: dashboard_pimpinan.php");
                exit();
            } else {
                $error_message = "Password salah!";
            }
        } else {
            $error_message = "Username tidak ditemukan atau bukan akun pimpinan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pimpinan</title>
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
            <h2 class="text-center mb-4">Login Pimpinan</h2>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form action="login_pimpinan.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-pink w-100">Login</button>
            </form>

            <p class="text-center mt-3">Belum punya akun? <a href="register_pimpinan.php" class="text-link">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
