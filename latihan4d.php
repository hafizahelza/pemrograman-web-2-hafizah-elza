<?php

$negaraasean = [
    ["Negara" => "Indonesia", "Ibu kota" => "D.K.I Jakarta", "Kode Telepon" => "+62"],
    ["Negara" => "Singapura", "Ibu kota" => "Singapura", "Kode Telepon" => "+65"],
    ["Negara" => "Malaysia", "Ibu kota" => "Kuala Lumpur", "Kode Telepon" => "+60"],  
    ["Negara" => "Brunei", "Ibu kota" => "Bandar Seri Begawan", "Kode Telepon" => "+673"],
    ["Negara" => "Thailand", "Ibu kota" => "Bangkok", "Kode Telepon" => "+66"], 
    ["Negara" => "Laos", "Ibu kota" => "Viantiane", "Kode Telepon" => "+856"], 
    ["Negara" => "Filipina", "Ibu kota" => "Manila", "Kode Telepon" => "+63"],  
    ["Negara" => "Myanmar", "Ibu kota" => "Naypyidaw", "Kode Telepon" => "+95"], 

];

echo "<table border='1'>";
echo "<tr>";
echo "<th>Negara</th>";
echo "<th>Ibu kota</th>";
echo "<th>Kode Telepon</th>";
echo "</tr>";

foreach ($negaraasean as $negara) {
    echo "<tr>";
    echo "<td>" . $negara["Negara"] . "</td>";
    echo "<td>" . $negara["Ibu kota"] . "</td>";
    echo "<td>" . $negara["Kode Telepon"] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>