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

$sql = "SELECT user_id, nama, alamat, nomor_telepon, jenis_kelamin, tanggal_lahir, email FROM Users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8b4d9, #ff85c1, #ff6fa3);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
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
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 1rem;
            vertical-align: middle;
        }

        table th {
            background-color: #ff6fa3;
            color: white;
            text-align: center;
        }

        table td {
            background-color: #f9f9f9;
        }

        /* Adding striped effect for better readability */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 15px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #ff6fa3;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff85c1;
            transform: scale(1.05);
        }

        .btn-secondary {
            background-color: #ddd;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #ccc;
            transform: scale(1.05);
        }

        .d-flex {
            margin-top: 20px;
        }

        .d-flex .btn {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pengguna</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                        <td><?= htmlspecialchars($row['nomor_telepon']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
            <a href="dashboard_pimpinan.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
