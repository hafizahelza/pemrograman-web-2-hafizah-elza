<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .box{
            width: 50px;
            height: 50px;
            border: 1px solid black;
            text-align: center;
            line-height: 50px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php
        $a = 'A';
        $b = 'B';
        $c = 'C';
        
        for($i = 0; $i <= 3; $i++){
            for($j = 0; $j < $i; $j++){
                if($j == 0) {
                    $huruf = $a;
                }elseif($j == 1){
                    $huruf = $b;
                }elseif($j == 2) {
                    $huruf = $c;
                }
                echo "<div class='box'>$huruf</div>";
               
            }
            echo '<br>';
        }
    ?>
</body>
</html>
