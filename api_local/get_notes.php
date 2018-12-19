<?php
require 'server_params.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=NotesDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$stmt = $conn->prepare("SELECT * FROM Notes");
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
