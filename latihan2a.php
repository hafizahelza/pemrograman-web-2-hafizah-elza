<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 2 - Latihan 1</title>
</head>
<body>
    <table border="1" cellpadding="3" cellpacing="0">
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
            <th>Kolom 3</th>
            <th>Kolom 4</th>
            <th>Kolom 5</th>
        </tr>

        <?php
       // Menententukan jumlah baris dan kolom
        $jumlahBaris = 15;
        $jumlahKolom = 5;

       //Looping untuk membuat baris
       for ($i = 1; $i <= $jumlahBaris; $i++) {
           echo "<tr>";

            // Looping untuk membuta kolom
            for ($j = 1; $j <= $jumlahKolom; $j++) {
                echo "<td>Baris $i, Kolom $j</td>";
            }

            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>