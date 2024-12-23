<?php
require 'vendor/autoload.php';
require 'koneksi.php'; // File koneksi database

use Dompdf\Dompdf;

// Query data dari database
$sql = "SELECT username, email FROM Users";
$result = $conn->query($sql);

// Persiapkan data untuk ditampilkan
$html = '
    <h1 style="text-align: center; color: #e91e63;">Cetak Data User</h1>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>';

$no = 1;
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . htmlspecialchars($row['username']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
              </tr>';
}

$html .= '</table>';

// Inisialisasi DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("data_user.pdf", ["Attachment" => 0]);
?>
