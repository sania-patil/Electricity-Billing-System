<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP tut </title>
</head>
<body>
    <div class = "container">
        This is my first php website
        <?php
        $var1 = 14;
       $var2 = 06;
        echo $var1+$var2;

        // operators
        // arithmatic =>  + - * / %,
        echo "<br>";
        echo "the value of var1 + var2 is ";
        echo $var1+$var2;
        echo "<br>";
        // assignment=> =, +=, -=, *=, /=, %=
        $newvar = $var1;
        echo "the value of new variable is ";
        echo $newvar; 
        echo "<br>";
        // comparison => return boolean values => ==, !=, <, >, <=, >=
        echo "the value of 1==4 is ";
        echo var_dump(1==4);
        // ,incremental => ++, --
        
        // ,logical => and(&&), or(||), xor
        $var = (true) and (true);
        echo "<br>";
        echo var_dump($var);
?>
        <?php
        // data types
        // 1. string
        // 2. integer
        // 3. float
        // 4. boolean
        // 5. array
        // 6. object

        echo "<br>";
        $string = "this is a string";
        echo $string;
        // how to define constant 
        echo "<br>";
        define("pi",3.14);
        echo pi;
        ?> 
    </div>
</body>
</html>