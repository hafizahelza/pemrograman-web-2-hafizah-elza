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

// Ambil data dari database
$sql = "SELECT email, nomor_telepon, nama, alamat, tanggal_lahir, jenis_kelamin FROM Users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff6fa3, #ff85c1, #f8b4d9);
            font-family: 'Poppins', sans-serif;
            color: #ff6fa3;
        }
        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        h2 {
            font-size: 2rem;
            color: #ff6fa3;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 1rem;
        }
        table th {
            background-color: #ff6fa3;
            color: black;
        }
        table td {
            background-color: #f8b4d9;
        }
        .btn-secondary {
            background-color: #ff6fa3;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 10px;
            color: black;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #ff85c1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pengguna</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['nomor_telepon']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="dashboard_pimpinan.php" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
