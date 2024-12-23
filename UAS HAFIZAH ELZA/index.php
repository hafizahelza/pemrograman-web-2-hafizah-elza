<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Event Kampus</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        /* Container Styling */
        .menu-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        .menu-container h1 {
            font-size: 26px;
            font-weight: 600;
            color: #e75480;
            margin-bottom: 10px;
        }

        .menu-container p {
            font-size: 14px;
            margin-bottom: 30px;
            color: #555;
        }

        /* Button Styles */
        .btn-custom {
            margin: 10px 0;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 30px;
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-admin {
            background-color: #ff6b81;
        }
        .btn-admin:hover {
            background-color: #e75480;
        }

        .btn-pimpinan {
            background-color: #d88aba;
        }
        .btn-pimpinan:hover {
            background-color: #bf71a4;
        }

        .btn-pendaftaran {
            background-color: #f78fb3;
        }
        .btn-pendaftaran:hover {
            background-color: #f06b91;
        }

        /* Footer Text */
        .footer {
            font-size: 12px;
            margin-top: 20px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h1>Selamat Datang!</h1>
        <p>Sistem Informasi Event Kampus</p>
        <a href="admin/admin_login.php" class="btn btn-custom btn-admin">Login Admin</a>
        <a href="pimpinan/login_pimpinan.php" class="btn btn-custom btn-pimpinan">Login Pimpinan</a>
        <a href="pendaftar/form.php" class="btn btn-custom btn-pendaftaran">Pendaftaran Event</a>
        <div class="footer">© 2024 EventKampus. All Rights Reserved.</div>
    </div>
</body>
</html>
