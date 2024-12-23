<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "eventkampus";  // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);  // Menampilkan pesan error jika koneksi gagal
}
echo "Koneksi berhasil!";
?>
