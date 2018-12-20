<?php

function findNote($id){
    require 'server_params.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$notesDbName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT idNote FROM Notes WHERE idNote=$id");
        $stmt->execute();
        
        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        return $result['idNote'];
        }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
};


?>  
