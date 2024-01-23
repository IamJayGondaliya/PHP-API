<?php
    //UPDATE    =>  PUT / PATCH

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: PUT, PATCH");

    include("../../config/config.php");

    $res = array();
    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == "PUT" || $_SERVER['REQUEST_METHOD'] == "PATCH") {

        $data = file_get_contents("php://input");   //  String
        $record = array();
        parse_str($data,$record);    //  String  =>  Array(id, name, age, course)

        $id = $record['id'];
        $name = $record['name'];
        $age = $record['age'];
        $course = $record['course'];

        $res['msg'] = $config->update($id,$name,$age,$course);

    }
    else {
        $res['msg'] = "Only PUT or PATCH method is allowed...";
    }

    echo json_encode($res);

?>