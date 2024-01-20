<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: POST");

    include("../../config/config.php");

    $res = array();
    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = $_POST['name'];
        $age = $_POST['age'];
        $course = $_POST['course'];

        $result = $config->insert($name,$age,$course);

        $res['msg'] = $result ? "Inserted..." : "Failled...";

        http_response_code($result ? 201 : 403);

    }
    else {
        $res['msg'] = "Only POST method is allowed...";
    }

    echo json_encode($res);

?>