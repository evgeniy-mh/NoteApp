<?php
use \Firebase\JWT\JWT;

function getUserId($jwt){
    require 'server_params.php';
    require_once 'vendor/autoload.php';
    
    try{
        $decoded = JWT::decode($jwt, $serverSecret, array('HS256'));
        return $decoded->userId;
    }
    catch(Exception $ex){
        echo 'Exception Message: ' .$ex->getMessage();
    }
}

?>