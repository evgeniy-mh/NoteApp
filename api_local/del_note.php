<?php
require 'server_params.php';
require 'find_note.php';

$method = $_SERVER['REQUEST_METHOD'];
if($method=='DELETE'){
        //$data = json_decode(file_get_contents('php://input'), true);

        $idNote=array_key_exists('id',$_GET)? $_GET["id"]: null;
        if(empty($idNote)){
            http_response_code(500);
            echo("id not specified");
        }else{
            echo($idNote);
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=NotesDB", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                if(empty(findNote($idNote))){
                        http_response_code(500);
                        echo("note not found");
                } else{
                        $conn->exec("DELETE FROM Notes WHERE idNote=$idNote");
                        http_response_code(200);
                }

                }catch(PDOException $e)
                {
                        http_response_code(500);
                        echo "Error: " . $e->getMessage();
                }
                $conn = null;
        }
        }else{
                http_response_code(500);
                echo ('server method error');
        }        
?>
