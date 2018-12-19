<?php
$data = json_decode(file_get_contents('php://input'), true);
$noteName=$data["noteName"];

if(!empty($noteName)){
        echo("Welcome ".$noteName);
}else{
        echo ("noteName is empty");
} 
?>
 
