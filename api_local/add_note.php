<?php
$data = json_decode(file_get_contents('php://input'), true);
$servername = "localhost";
$username = "root";
$password = "";

if(array_key_exists('idUser',$data) && array_key_exists('noteName',$data)){
        $idUser=$data["idUser"];
        $noteName=$data["noteName"];

        $noteContent=array_key_exists('noteContent',$data)?$data["noteContent"]:null;
        $noteDate=array_key_exists('noteDate',$data)?$data["noteDate"]:null;

        try {
                $conn = new PDO("mysql:host=$servername;dbname=NotesDB", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare(
                        "INSERT INTO Notes 
                        (noteName,noteContent,idUser,noteDate)
                        VALUES
                        (:noteName,:noteContent,:idUser,:noteDate)"
                );
                $stmt->bindParam(':noteName',$noteName);
                $stmt->bindParam(':noteContent',$noteContent);
                $stmt->bindParam(':idUser',$idUser);
                $stmt->bindParam(':noteDate',$noteDate);
                $stmt->execute();
                
                $last_id = $conn->lastInsertId();
                $responceJSON=json_encode(array("last_id"=>$last_id));
                echo($responceJSON);           
                }
        catch(PDOException $e)
        {
                echo "Error: " . $e->getMessage();
        }
        $conn = null;
}else{        
        echo("error");
}
?>
 
