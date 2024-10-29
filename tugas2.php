<?php
$headers = [
            "No", 
            "Nama Daerah",
            "Gambar",
            "Makanan Khas", 
            "Pakaian Adat", 
            "Upacara Adat", 
            "Alat Musik Tradisional" 
        ];
$Daerah = [
    [
        "Nama Daerah" => "Jambi",
        "Makanan Khas" => "Gulai Ikan Patin",
        "Pakaian Adat" => "Baju Kurung Tanggung",
        "Upacara Adat" => "Besale",
        "Alat Musik Tradisional" => "Gambus dan Kalintang",
        "Gambar" => "gambar/jambi.jpg"
    ],
    [
        "Nama Daerah" => "Sumatra Barat",
        "Makanan Khas" => "Rendang",
        "Pakaian Adat" => "Baju Bundo Kanduang",
        "Upacara Adat" => "Tabuik",
        "Alat Musik Tradisional" => "Saluang",
        "Gambar" => "gambar/sumatrabarat.jpg"
    ],
    [
       "Nama Daerah" => "Jawa Barat",
        "Makanan Khas" => "Karedok",
        "Pakaian Adat" => "Kebaya Sunda",
        "Upacara Adat" => "Seren Taun",
        "Alat Musik Tradisional" => "Angklung",
        "Gambar" => "gambar/jawabarat.jpg"
    ],
    [
        "Nama Daerah" => "Aceh",
        "Makanan Khas" => "Kuah Plieku",
        "Pakaian Adat" => "Baju Kurung Aceh",
        "Upacara Adat" => "Peusijuek",
        "Alat Musik Tradisional" => "Serune Kalee",
        "Gambar" => "gambar/aceh.jpeg"
    
    ],
    [
        "Nama Daerah" => "Sulawesi Selatan",
        "Makanan Khas" => "Coto Makassar",
        "Pakaian Adat" => "Baju Bodo",
        "Upacara Adat" => "Rambu Solo",
        "Alat Musik Tradisional" => "Kecapi",
        "Gambar" => "gambar/sulawesi selatan.jpg"
    ],
    [
        "Nama Daerah" => "Nusa Tenggara Timur",
        "Makanan Khas" => "Se'i",
        "Pakaian Adat" => "Tenun Ikat",
        "Upacara Adat" => "Reba",
        "Alat Musik Tradisional" => "Sasado",
        "Gambar" => "gambar/ntt.jpg"
    ],
    [
        "Nama Daerah" => "Papua",
        "Makanan Khas" => "Papeda",
        "Pakaian Adat" => "Koteka",
        "Upacara Adat" => "Barapen",
        "Alat Musik Tradisional" => "Tifa",
        "Gambar" => "gambar/papua.jpeg"
    ],
    [
       "Nama Daerah" => "Kalimantan Timur",
        "Makanan Khas" => "Ayam Cincane",
        "Pakaian Adat" => "Baju Ta'a",
        "Upacara Adat" => "Erau",
        "Alat Musik Tradisional" => "Sampek",
        "Gambar" => "gambar/kalimantantimur.jpg"
    ],
    [
        "Nama Daerah" => "Maluku",
        "Makanan Khas" => "Ikan Asar",
        "Pakaian Adat" => "Baju Cele",
        "Upacara Adat" => "Pela Gandong",
        "Alat Musik Tradisional" => "Pela Gandong",
        "Gambar" => "gambar/maluku.jpg"
    ],
    [
       "Nama Daerah" => "Yogyakarta",
        "Makanan Khas" => "Gudeg",
        "Pakaian Adat" => "Kebaya Jawa",
        "Upacara Adat" => "Sekaten",
        "Alat Musik Tradisional" => "Gamelan",
        "Gambar" => "gambar/yogyakarta.jpg"
    ]
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%; 
        }
        td, th {
            text-align: center; 
        }
    </style>
</head>
<body>
    <table border="2" cellpadding="3" cellspacing="3">
            <tr>
                <?php foreach($headers as $header): ?>
                    <th><?=  $header?></th>
                <?php endforeach ; ?>
            </tr>
        <?php foreach($Daerah as $index => $Daerh) : ?>
            <tr>
                <td><?= $index + 1 ?></td> 
                <td><?= $Daerh['Nama Daerah'] ?></td>
                <td style="display: flex; justify-content: center;"><img src="<?= $Daerh['Gambar']?>" weight="50" height="50" ></td>
                <td><?= $Daerh['Makanan Khas'] ?></td>
                <td><?= $Daerh['Pakaian Adat'] ?></td>
                <td><?= $Daerh['Upacara Adat'] ?></td>
                <td><?= $Daerh['Alat Musik Tradisional']?></td>
            </tr>
        <?php endforeach ; ?>

    </table>
</body>
</html>