<?php
session_start();
if (!isset($_SESSION['pimpinan_id'])) {
    header("Location: login_pimpinan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f0; /* Background pink pastel */
            color: #6b3054; /* Teks ungu tua */
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 100px;
            text-align: center;
        }
        .btn-custom {
            background-color: #ff66a3; /* Warna tombol pink cerah */
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e60073; /* Hover lebih gelap */
        }
        .card {
            background-color: #fff0f5; /* Card pink lembut */
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h1>Download Data Pengguna</h1>
            <p class="mb-4">Klik tombol di bawah untuk mengunduh data pengguna dalam format CSV.</p>
            <a href="export_data.php" class="btn btn-custom btn-lg">Download CSV</a>
        </div>
    </div>
</body>
</html>
