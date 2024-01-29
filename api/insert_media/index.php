<?php

/*
        {
            ["img"]=>
                array(5) {
                ["name"]=>
                string(21) "Android Large - 1.png"
                ["type"]=>
                string(9) "image/png"
                ["tmp_name"]=>
                string(24) "C:\xampp\tmp\phpC382.tmp"
                ["error"]=>
                int(0)
                ["size"]=>
                int(25253)
            }
}

*/

    header("Content-Type: application/json");
    header("Access-Control-Allow-Method: POST");

    include("../../config/config.php");

    $config = new Config();

    $res = array();

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $data = $_FILES;

        $imgName = $data['img']['name'];
        $imgPath = $data['img']['tmp_name'];

        $name = uniqid("PHP-") . $imgName;

        $destination = "../../uploads/$name";

        $uploaded = move_uploaded_file($imgPath,$destination);

        if($uploaded) {

            $res['msg'] = $config->insertMedia($name,$destination) ? "Inserted done.." : "Insertion failled...";

        }
        else {
            $res['msg'] = "Failled to upload...";
        }
    }
    else {
        $res['msg'] = "Only POST method is allowed...";
    }

    echo json_encode($res);

?>