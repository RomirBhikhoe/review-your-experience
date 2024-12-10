<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=mellespellen","root","");
}catch (PDOException $e){
    die("Kon niet verbinden T-T");
}
?>
