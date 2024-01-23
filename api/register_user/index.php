<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Method: POST");

include("../../config/config.php");

$res = array();
$config = new Config();

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $res['msg'] = $config->register_user($user_name,$password);
}
else {
    $res['msg'] = "Only POST method is allowed...";
}

echo json_encode($res);

?>