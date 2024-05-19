<?php 

require_once "Sql.php"; 
$id = $_GET['id'] ; 

$db =new Sql(); 
$stmt = $db->prepare("select * from estagiarios where id = :id");
$stmt->bindValue(":id",$id); 
$stmt->execute();
$resultado=$stmt->fetch(PDO::FETCH_ASSOC); 
$resultado =json_encode($resultado);
print_r($resultado);