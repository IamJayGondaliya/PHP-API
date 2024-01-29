<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: DELETE");

    include("../../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "DELETE") {

        $str = file_get_contents("php://input");
        $arr = array();
        parse_str($str,$arr);

        $id = $arr['id'];

        $res['msg'] = $config->deleteMedia($id);

    }

    echo json_encode($res);

?>