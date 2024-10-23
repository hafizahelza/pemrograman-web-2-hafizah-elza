<?php
function ganti_style($tulisan, $kelas){
    return "<span class='$kelas'>$tulisan</span>";

}
$tulisan = "Hello World! Here I come!";
$kelas = "ganti_style";

echo ganti_style($tulisan, $kelas);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .ganti_style{
            font-size: 28px;
            font-family: arial;
            color: #1A0547;
            font-style: italic;
            font-weight: bold;

        }
    </style>
</head>
<body>
    
</body>
</html>