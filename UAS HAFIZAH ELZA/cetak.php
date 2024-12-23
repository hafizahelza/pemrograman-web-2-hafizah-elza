<?php
// Sertakan autoload Composer
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// Contoh data yang akan dicetak
$html = '
    <h1 style="text-align: center; color: #e91e63;">Cetak Data PDF</h1>
    <p>Berikut adalah contoh data yang akan dicetak dalam format PDF.</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>johndoe@example.com</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>janesmith@example.com</td>
        </tr>
    </table>
';

// Inisialisasi DOMPDF
$dompdf = new Dompdf();

// Load konten HTML ke DOMPDF
$dompdf->loadHtml($html);

// (Opsional) Atur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render HTML ke PDF
$dompdf->render();

// Keluarkan file PDF ke browser
$dompdf->stream("cetak_data.pdf", ["Attachment" => 0]);
?>
