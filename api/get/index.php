<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: GET");

    include("../../config/config.php");

    $config = new Config();

    $res = array();
    $res['data'] = array();

    if($_SERVER['REQUEST_METHOD'] == "GET") {

        $data = $config->getAllData();  //mysqli_result     =>      mysqli_fetch_array
        $length = 0;
        while($record = mysqli_fetch_array($data)) {            
            for($i = 0; $i < 4; $i++) {
                unset($record[$i]);
            }
            array_push($res['data'],$record);
            $length++;
        }
        $res['count'] = $length;
        http_response_code(200);
    }
    else {
        $res['msg'] = "Only GET method is allowed...";
    }

    echo json_encode($res);
?>