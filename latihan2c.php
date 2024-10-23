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
            margin: 1px;
            
        }
        .ganjil{
            background-color: #003;
            color: #fff;
        }
        .genap{
            background-color: #999;
        }
    </style>
</head>
<body>
    <?php
    for($i = 1; $i <= 5; $i++){
            for($j =1; $j <= $i; $j++){
                if($i % 2 == 1){
                    echo "<div class=' box ganjil'>$j</div>";
                }else {
                    echo "<div class=' box genap'>$j</div>";
                }
            }
            echo "</br>";
    }   
    ?>
</body>
</html>