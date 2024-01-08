<?php

    //  mixly typed language.       =>  dart.
    //  staticly typed language     =>  fixed data types. c, c++
    //  dynamically typed language  =>  no predefined data types.   js, Php

    $a = 10;
    $b = 20;
    $sum = $a + $b;
    $data = "Sum of $a and $b: ";

    print "a: " . $a . "<br>";
    print "b: " . $b . "<br>";
    print $data . $sum;
    echo "<hr>";

    echo $a > $b ? "a is big" : "b is big";

    echo "<hr>";
    echo "Hello PHP !! <br>" . "Another data <br>"; //  return nothing
    print "New DATA" . "Another new....";           //  returns 1

?>