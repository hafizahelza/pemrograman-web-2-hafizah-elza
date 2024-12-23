<?php
session_start();

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $nomor_telepon = trim($_POST['nomor_telepon']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validasi input
    if (empty($email) || empty($username) || empty($password) || empty($nomor_telepon) || empty($nama) || empty($alamat) || empty($tanggal_lahir)) {
        echo "Semua field harus diisi.";
        exit();
    }

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

    // Cek apakah nomor telepon sudah ada
    $stmt_phone = $conn->prepare("SELECT nomor_telepon FROM Users WHERE nomor_telepon = ?");
    $stmt_phone->bind_param("s", $nomor_telepon);
    $stmt_phone->execute();
    $stmt_phone->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email ini sudah terdaftar, silakan gunakan email lain.";
    } elseif ($stmt_username->num_rows > 0) {
        echo "Username ini sudah terdaftar, silakan pilih username lain.";
    } elseif ($stmt_phone->num_rows > 0) {
        echo "Nomor telepon ini sudah terdaftar, silakan gunakan nomor lain.";
    } else {
        if (empty($nomor_telepon)) {
            echo "Nomor telepon tidak boleh kosong.";
        } else {
            $stmt_insert = $conn->prepare("INSERT INTO Users (username, nama, alamat, tanggal_lahir, email, password, nomor_telepon, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $role_id = 3; // Menganggap role_id 3 untuk pengguna biasa

            $stmt_insert->bind_param("sssssssi", $username, $nama, $alamat, $tanggal_lahir, $email, $hashed_password, $nomor_telepon, $role_id); 

            if ($stmt_insert->execute()) {
                echo "Pendaftaran berhasil!";
                // Redirect ke login page atau halaman lainnya setelah berhasil
                header("Location: login.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat pendaftaran: " . $stmt_insert->error;
            }
        }
    }

    // Menutup statement
    $stmt->close();
    $stmt_username->close();
    $stmt_phone->close();
    $stmt_insert->close();
}

$conn->close();
?>