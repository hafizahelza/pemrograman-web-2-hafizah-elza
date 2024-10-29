<?php
$namanegara = ["Indonesia", "Singapura", "Malaysia", "Brunei", "Thailand"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Looping for array</title>
</head>
<body>
    <h3>Daftar Negara ASEAN awal:</h3>
        <?php
            for ($i = 0; $i < count($namanegara); $i++) {
            echo "<li>$namanegara[$i]</li>";
        }
$namanegara = ["Indonesia", "Singapura", "Malaysia", "Brunei", "Thailand"];
    array_push($namanegara, "Laos", "Filipina",);


    $namanegara[] = "Myanmar";
    echo "<h3>Daftar Negara ASEAN baru:</h3>";
    for ($i = 0; $i < count($namanegara); $i++) {
    echo "<li>$namanegara[$i]</li>";
}

    ?>


</body>
</html>