<?php
require_once 'server_params.php';
require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents('php://input'), true);
if(array_key_exists('login',$data) && array_key_exists('pass',$data)){
        $login=$data["login"];
        $pass=$data["pass"];        

        try {                
                $conn = new PDO("mysql:host=$servername;dbname=$notesDbName", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                $stmt = $conn->prepare("SELECT userId FROM User WHERE username=:login AND password=:pass");
                $stmt->bindParam(':login',$login);
                $stmt->bindParam(':pass',$pass);

                $stmt->execute();
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                
                if(!$result){
                        http_response_code(500);
                        echo("user not found");
                        exit;
                }

                $userId=$result["userId"];

                $token = array(
                        "userId" => $userId
                );

                $jwt = JWT::encode($token, $serverSecret);

                echo($jwt);

                }
        catch(PDOException $e)
        {
                http_response_code(500);
                echo "Error: " . $e->getMessage();
        }
        $conn = null;
}else{
        http_response_code(500);
        echo("error");
}
?>

