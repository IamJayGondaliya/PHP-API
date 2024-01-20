<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: DELETE");

    include("../../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "DELETE") {

        $data = array();
        $str = file_get_contents('php://input');  //String(Array)
        //String    =>  Array
        parse_str($str,$data);
        $id = $data['id'];

        $record = $config->getSingleRecord($id); 
        
        if(mysqli_num_rows($record)) {            
            $result = $config->delete($id);

            $res['msg'] = $result ? "Deleted successfully..." : "Deletion failled...";
        }
        else {
            http_response_code(403);
            $res['msg'] = "Record not found...";
        }

    }
    else {
        $res['msg'] = "Only DELETE method is allowed...";
    }

    echo json_encode($res);

?>