<?php

function HitungDiskon($JumlahBayar) {
    if ($JumlahBayar >= 50000){
    $Diskon =5;
}
    elseif ($JumlahBayar >= 100000) {
        $Diskon =10;
    }
    elseif ($JumlahBayar >= 500000) {
        $Diskon =50;
    } 
    else {
        $Diskon = 0;
    }

    $TotalDiskon =($JumlahBayar * $Diskon) /100;
    $TotalBayarAkhir = $JumlahBayar - $TotalDiskon;

    echo "Total Bayar Rp. " . number_format($JumlahBayar) . "<br>";
    echo "Diskon: " . $Diskon . "%<br>";
    echo "Total setelah diskon: Rp. " . number_format($TotalBayarAkhir) . "<br>";
}

    $JumlahBayar = 345000;
    HitungDiskon($JumlahBayar)

    ?>