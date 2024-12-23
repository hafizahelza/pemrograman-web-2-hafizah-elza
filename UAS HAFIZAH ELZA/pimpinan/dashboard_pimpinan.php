<?php
session_start();

// Periksa apakah pimpinan sudah login
if (!isset($_SESSION['pimpinan_id'])) {
    header("Location: login_pimpinan.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gradient Background */
        body {
            background: linear-gradient(135deg, #ffd1dc, #ffb6c1, #ff99c8); 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* Dashboard Container */
        .container {
            background-color: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            text-align: center;
            position: relative;
        }

        /* Header Title */
        h2 {
            font-size: 2.5rem;
            color: #ff4c8b;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Welcome Text */
        .welcome-text {
            font-size: 1.2rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Buttons Styling */
        .btn-custom {
            border-radius: 30px;
            font-size: 1.1rem;
            padding: 12px 25px;
            transition: all 0.3s ease-in-out;
            margin: 10px auto;
            width: 90%;
            color: white;
        }

        .btn-info {
            background-color: rgb(237, 161, 192);
            border: none;
        }

        .btn-info:hover {
            background-color: rgb(216, 138, 169);
        }

        .btn-success {
            background-color: rgb(117, 71, 87);
            border: none;
        }

        .btn-success:hover {
            background-color: rgba(185, 100, 160, 1);
        }

        /* Logout Button - Smaller and Positioned Better */
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff4c8b;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 0.9rem;
            padding: 8px 15px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff66a3;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Logout di pojok kanan atas -->
        <a href="logout_pimpinan.php" class="logout-btn">Logout</a>

        <!-- Header -->
        <h2>Dashboard Pimpinan</h2>

        <!-- Tulisan Selamat Datang -->
        <p class="welcome-text">Selamat Datang di Dashboard Pimpinan, tempat mengelola data </p>

        <!-- Tombol Navigasi -->
        <div class="buttons-container">
            <a href="lihat_data_pimpinan.php" class="btn btn-info btn-custom">Lihat Data</a>
            <a href="download_data.php" class="btn btn-success btn-custom">Download Data</a>
            <a href="cetak_data.php" class="btn btn-info btn-custom">Cetak Data</a>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
