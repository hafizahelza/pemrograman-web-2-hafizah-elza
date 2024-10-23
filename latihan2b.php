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
    </style>
</head>
<body>
    <?php
    for($i = 1; $i <= 5; $i++){
        echo "</br>";
        for($j =1; $j <= $i; $j++){
            echo "<div class='box'>$j </div>";
        }
    }
    ?>
</body>
</html>