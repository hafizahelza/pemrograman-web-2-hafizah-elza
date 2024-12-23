<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

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

$user_id = $_GET['id'] ?? null;

if ($user_id) {
    // Ambil detail pengguna berdasarkan user_id
    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Data pengguna tidak ditemukan!";
        exit;
    }
} else {
    echo "ID pengguna tidak valid!";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pengguna</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background: linear-gradient(135deg, #f8b4d9, #ffe3ec, #fbd5ea);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Poppins", sans-serif;
        overflow: hidden;
      }

      .card {
        background: #fff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        z-index: 2;
      }

      .card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(
          circle,
          rgba(255, 105, 180, 0.2),
          rgba(255, 105, 180, 0)
        );
        z-index: -1;
        transform: rotate(45deg);
      }

      h2 {
        font-weight: bold;
        font-size: 2rem;
        color: #ff6fa3;
        text-align: center;
        margin-bottom: 1rem;
      }

      label {
        font-weight: 600;
        color: #ff6fa3;
      }

      .form-control {
        border-radius: 15px;
      }

      .form-control:focus {
        border-color: #ff6fa3;
        box-shadow: 0 0 8px rgba(255, 111, 163, 0.5);
      }

      .btn-primary {
        background: linear-gradient(135deg, #ff6fa3, #ff85c1);
        border: none;
        border-radius: 15px;
        padding: 0.7rem 1.5rem;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
      }

      .btn-primary:hover {
        background: linear-gradient(135deg, #ff85c1, #ffa6d3);
        transform: scale(1.05);
      }

      .decorative-circle {
        position: absolute;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: linear-gradient(
          135deg,
          rgba(255, 255, 255, 0.3),
          rgba(255, 255, 255, 0)
        );
        animation: float 6s ease-in-out infinite;
        z-index: 1;
      }

      .circle-1 {
        top: 10%;
        left: 80%;
        animation-delay: 0s;
      }

      .circle-2 {
        bottom: 5%;
        right: 70%;
        animation-delay: 2s;
      }

      @keyframes float {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(20px);
        }
      }
    </style>
  </head>
  <body>
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h2>Detail Pengguna</h2>
              <table class="table table-bordered">
                <tr>
                  <th>Username</th>
                  <td><?= htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td><?= htmlspecialchars($user['nama']); ?></td> <!-- Nama -->
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?= htmlspecialchars($user['email']); ?></td>
                </tr>
                <tr>
                  <th>Nomor Telepon</th>
                  <td><?= htmlspecialchars($user['nomor_telepon']); ?></td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td><?= htmlspecialchars($user['alamat']); ?></td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <td><?= htmlspecialchars($user['tanggal_lahir']); ?></td> <!-- Tanggal Lahir -->
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td><?= htmlspecialchars($user['jenis_kelamin']); ?></td> <!-- Jenis Kelamin -->
                </tr>
                <tr>
                  <th>Foto</th>
                  <td><img src="<?= htmlspecialchars($user['foto_path']); ?>" alt="Foto Pengguna" width="150"></td>
                </tr>
              </table>
              <a href="admin_dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
