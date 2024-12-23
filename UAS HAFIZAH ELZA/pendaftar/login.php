<?php
session_start();
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
} else {
    $message = "Pendaftaran berhasil!"; // Pesan default jika tidak ada pesan dari session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8b4d9, #ffe3ec);
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .notification-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            text-align: center;
            position: relative;
        }
        .notification-card h1 {
            font-size: 2rem;
            color: #ff6fa3;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .notification-card p {
            font-size: 1rem;
            color: #555;
        }
        .btn-close-custom {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff6fa3;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
        .btn-close-custom:hover {
            background: #ff85c1;
            transform: scale(1.1);
        }
        .btn-close-custom span {
            color: #fff;
            font-size: 1.2rem;
            line-height: 0;
        }
        .decorative-circle {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 105, 180, 0.2);
            animation: float 6s ease-in-out infinite;
            z-index: -1;
        }
        .circle-1 {
            top: -50px;
            left: -50px;
        }
        .circle-2 {
            bottom: -50px;
            right: -50px;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(20px);
            }
        }
    </style>
</head>
<body>
    <div class="notification-card">
        <button class="btn-close-custom" onclick="closeNotification()">
            <span>&times;</span>
        </button>
        <h1>🎉 Sukses!</h1>
        <p><?= htmlspecialchars($message); ?></p>
    </div>
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>

    <script>
        function closeNotification() {
            document.querySelector('.notification-card').style.display = 'none';
        }
    </script>
</body>
</html>
