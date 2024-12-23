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

// Proses pendaftaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $nama = $_POST['nama']; // Ambil nama dari form
    $alamat = $_POST['alamat']; // Ambil alamat dari form
    $tanggal_lahir = $_POST['tanggal_lahir']; // Ambil tanggal_lahir dari form
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT email FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Cek apakah username sudah terdaftar
    $stmt_username = $conn->prepare("SELECT username FROM Users WHERE username = ?");
    $stmt_username->bind_param("s", $username);
    $stmt_username->execute();
    $stmt_username->store_result();

    // Cek apakah nomor telepon sudah ada (jika diperlukan)
    $stmt_phone = $conn->prepare("SELECT nomor_telepon FROM Users WHERE nomor_telepon = ?");
    $stmt_phone->bind_param("s", $nomor_telepon);
    $stmt_phone->execute();
    $stmt_phone->store_result();

    if ($stmt->num_rows > 0) {
        // Jika email sudah terdaftar
        echo "Email ini sudah terdaftar, silakan gunakan email lain.";
    } elseif ($stmt_username->num_rows > 0) {
        // Jika username sudah terdaftar
        echo "Username ini sudah terdaftar, silakan pilih username lain.";
    } elseif ($stmt_phone->num_rows > 0) {
        // Jika nomor telepon sudah terdaftar
        echo "Nomor telepon ini sudah terdaftar, silakan gunakan nomor lain.";
    } else {
        // Validasi agar nomor telepon tidak kosong
        if (empty($nomor_telepon)) {
            echo "Nomor telepon tidak boleh kosong.";
        } else {
            // Jika email, username, dan nomor telepon belum terdaftar, proses registrasi
            // Pastikan jumlah parameter di bind_param sama dengan jumlah kolom di query
            $stmt_insert = $conn->prepare("INSERT INTO Users (username, nama, alamat, tanggal_lahir, email, password, nomor_telepon, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $role_id = 1; // Menganggap role_id 3 untuk pengguna biasa

            // Pastikan bind_param cocok dengan jumlah parameter di query (8 parameter)
            $stmt_insert->bind_param("sssssssi", $username, $nama, $alamat, $tanggal_lahir, $email, $hashed_password, $nomor_telepon, $role_id); 

            if ($stmt_insert->execute()) {
                echo "Pendaftaran berhasil!";
                // Redirect ke login page atau halaman lainnya setelah berhasil
                header("Location: login.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat pendaftaran.";
            }
        }
    }

    // Menutup statement
    $stmt->close();
    $stmt_username->close();
    $stmt_phone->close();
}

$conn->close();
?>
