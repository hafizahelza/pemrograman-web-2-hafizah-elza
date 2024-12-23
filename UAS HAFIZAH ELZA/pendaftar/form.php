<?php
session_start();

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

$errors = [];
$success_message = "";

// Proses pendaftaran jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi input
    $nama = htmlspecialchars(trim($_POST['nama']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $tanggal_lahir = htmlspecialchars(trim($_POST['tanggal_lahir']));
    $jenis_kelamin = htmlspecialchars(trim($_POST['jenis_kelamin']));
    $email = htmlspecialchars(trim($_POST['email']));
    $nomor_telepon = htmlspecialchars(trim($_POST['nomor_telepon']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Validasi input
    if (empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($email) || empty($nomor_telepon) || empty($username) || empty($password)) {
        $errors[] = "Semua kolom wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Jika tidak ada error, lanjutkan proses
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek email atau username sudah ada
        $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email atau username sudah digunakan.";
        } else {
            $role_id = 3; // Role default pengguna

            // Simpan data ke database
            $stmt_insert = $conn->prepare("INSERT INTO Users (username, nama, alamat, tanggal_lahir, jenis_kelamin, email, password, nomor_telepon, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("ssssssssi", $username, $nama, $alamat, $tanggal_lahir, $jenis_kelamin, $email, $hashed_password, $nomor_telepon, $role_id);
        
            if ($stmt_insert->execute()) {
                $success_message = "Pendaftaran berhasil! Silakan login.";
            } else {
                $errors[] = "Terjadi kesalahan saat menyimpan data: " . $stmt_insert->error;
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
    <title>Form Pendaftaran Event Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="text-center mb-4 text-danger">Form Pendaftaran Event Kampus</h2>

            <!-- Menampilkan pesan error -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Menampilkan pesan sukses -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <!-- Kolom input form -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="nomor_telepon" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Daftar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
