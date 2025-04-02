<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php tut 2</title>
</head>
<style>
    .container{
        background-color: rgb(238, 238, 238);
        border: 2px solid black;
        padding: 34px;
        margin: 34px;
    }
</style>
<body>
   <div class="container">
    this is container
    <br>
        <?php
        $age = 3;
        if($age>18){
            echo "you can drink water";
        }
        else{
            echo "you cannot drink water";
        }
        // array in php
        echo "<br>";
        $languages = array("python", "c++", "php", "nodejs");
        echo $languages[0];
        ?>
</div>
</body>
</html>