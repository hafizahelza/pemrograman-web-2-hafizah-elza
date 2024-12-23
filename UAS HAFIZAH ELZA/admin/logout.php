<?php
session_start();

// Hapus semua data sesi
session_destroy();

// Arahkan kembali ke halaman login
header("Location: admin_login.html");
exit();
?>
