<?php

    include("config/config.php");

    $config = new Config();

    /*
        Associative array   =>  Map => key & value

        Super globals:

        $_GET       =>  Associative array   => by form method
        $_POST      =>  Associative array   => by form method
        $_REQUEST   =>  Associative array   => submit / button press
        $_SERVER    =>  Associative array   => at the time of API call

        Error handler:  '@'
            - assigns value after initialization of the variable being assigned.
    */

    $submit_btn = @$_REQUEST['submit_btn'];

    if(isset($submit_btn)) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $course = $_POST['course'];

        $config->insert($name,$age,$course);
    }

?>

<!-- Boiler plate   =>  !   : Emmet Abbreviation -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Page</title>
    </head>
    <body>
        <!-- get/post -->
        <form action="" method="post">
            Name: <input type="text" name="name"> <br>
            Age: <input type="number" name="age"> <br>
            Course: <input type="text" name="course"> <br>
            <input type="submit" value="SUBMIT" name="submit_btn">
        </form>
    </body>
</html>