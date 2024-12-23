<?php
session_start();
include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa login pimpinan (role_id = 1)
    $stmt = $conn->prepare("SELECT user_id, password FROM Users WHERE username = ? AND role_id = 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['pimpinan_id'] = $user['user_id'];
            header("Location: pimpinan_dashboard.php"); // Halaman dashboard pimpinan
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan atau Anda bukan pimpinan!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background gradient dengan tema pink */
        body {
            background: linear-gradient(to right, #ff8da1, #ff94b3, #ffb3c1);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff4b87;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-pink {
            background-color: #ff4b87;
            border-color: #ff4b87;
            color: white;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn-pink:hover {
            background-color: #ff3385;
            border-color: #ff3385;
        }

        .error-message {
            color: #ff4b87;
            text-align: center;
            margin-bottom: 15px;
        }

        p {
            text-align: center;
        }

        a {
            color: #ff4b87;
            text-decoration: none;
        }

        a:hover {
            color: #ff3385;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Pimpinan</h2>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form action="login_pimpinan.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-pink w-100">Login</button>
        </form>
        <p class="mt-3">Belum memiliki akun? <a href="../admin_register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
