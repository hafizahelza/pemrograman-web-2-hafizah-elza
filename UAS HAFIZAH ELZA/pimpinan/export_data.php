<?php
session_start();
if (!isset($_SESSION['pimpinan_id'])) {
    header("Location: login_pimpinan.php");
    exit();
}

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

// Set header untuk download CSV
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=data_pengguna.csv");

$output = fopen("php://output", "w");

// Menulis header kolom CSV
fputcsv($output, ['Nama', 'Alamat', 'Nomor Telepon', 'Jenis Kelamin', 'Tanggal Lahir', 'Email', 'Foto']);

$sql = "SELECT nama, alamat, nomor_telepon, jenis_kelamin, tanggal_lahir, email, foto_path FROM Users";
$result = $conn->query($sql);

// Menulis data pengguna ke dalam file CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['nama'], 
        $row['alamat'], 
        $row['nomor_telepon'], 
        $row['jenis_kelamin'], 
        $row['tanggal_lahir'], 
        $row['email'], 
        $row['foto_path'] // Menambahkan kolom foto
    ]);
}

fclose($output);
$conn->close();
?>
