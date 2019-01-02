<?php
require_once 'server_params.php';
require_once 'check_jwt.php';

$headers = apache_request_headers();
/*foreach ($headers as $key => $value) {
    echo("$key: $value\n");
}*/
$jwt=$headers["authorization"];
$jwt=substr($jwt,strlen("Bearer "));
//echo($jwt);

$userId=getUserId($jwt);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$notesDbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$stmt = $conn->prepare("SELECT * FROM `Note` left join `User` ON `Note`.`user_userId`=`User`.`userId` WHERE `User`.`userId`=$userId");
    $stmt->execute();
    
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($result);
    echo($json);

    }
catch(PDOException $e)
    {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
    }
    $conn = null;
?> 
