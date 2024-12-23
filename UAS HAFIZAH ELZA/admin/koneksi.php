<?php
$host = "localhost";
$user = "root"; // Sesuaikan jika berbeda
$password = "";
$dbname = "eventkampus";

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
