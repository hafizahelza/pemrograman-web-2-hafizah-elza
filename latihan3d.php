<?php

function faktorial($a){

    if($a < 0){
        echo"faktorial bilangan negatif tidak didefinisikan";
        exit;

    }elseif($a == 0){

        return 1;
    }else{
        return $a * faktorial($a - 1);
    }
   
}
$hasil = faktorial(5);
echo "faktorial dari 5 = $hasil";

?>