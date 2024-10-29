<?php
$negaraasean = [
    "Indonesia" => "D.K.I Jakarta",
    "Singapura" => "Singapura",
    "Malaysia" => "Kuala Lumpur",
    "Brunei" => "Bundar Seri Begawan",
    "Thailand" => "Bangkok",
    "Laos" => "Vientiane",
    "Filipina" =>  "Manila",
    " Myanmar" => "Naypydaw",];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>array assosiative</title>
</head>
<body>
    <?php

    foreach ($negaraasean as $negara => $ibukota) : ?>
        <li><?php echo "$negara : $ibukota" ?></li>
    <?php endforeach ?>
</body>
</html>

