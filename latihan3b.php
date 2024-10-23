

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Fungsi isset</h3>
    <p>
    isset adalah sebuah fungsi bawaan PHP yang digunakan untuk memeriksa apakah sebuah variabel telah di-set (diberi nilai) dan tidak bernilai NULL. 
    Fungsi ini mengembalikan nilai TRUE jika variabel tersebut ada dan tidak bernilai NULL,
    dan mengembalikan nilai FALSE jika variabel tersebut tidak ada atau bernilai NULL.
    </p>
    <br>
    <?php
$a = "Hello";
$b = null;

if(isset($a)){
    echo "variabel \$a telah di-set dan tidak bernilai null </br>";

}else{
    echo "variabel \$a belum di-set atau bernilai null";
}

if(isset($b)){
    echo "variabel \$b telah di-set dan tidak bernilai null";
}
else{
    echo "variabel \$b belum di-set atau bernilai null";
}
?>
<br>
<h3>Fungsi Empty</h3>
<p>empty adalah sebuah fungsi bawaan PHP yang digunakan untuk memeriksa apakah sebuah variabel kosong atau tidak.
    Fungsi ini mengembalikan nilai TRUE jika variabel tersebut kosong, dan FALSE jika variabel tersebut tidak kosong.</p>
<br>
<?php
$a = "";
$b = "Hello";

if(empty($a)){
    echo "variabel \$a kosong </br>";
}else{
    echo "variabel \$a tidak kosong";
}

if(empty($b)){
    echo "variable \$b kosong";
}else{
    echo "variabel \$b tidak kosong";
}
?>
</body>
</html>