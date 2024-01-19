<?php

    header("Content-Type: application/json");

    //Associative array  =>  key - value
    $a = array();

    $a = [
        'id' => 101,
        'name' => "Aman",
        'per' => 95.41,
    ];

    // array_push($a,"Male");
    // array_push($a,"GSEB");
    $a['gender'] = "Male";

    // unset($a['per']);

    echo json_encode($a);

?>