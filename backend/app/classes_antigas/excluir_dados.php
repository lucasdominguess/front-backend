<?php 
// session_start();
session_start();
if($_SESSION["email"] == null){
    header('location: http://localhost:9000');
}

require 'Sql.php';

$id = $_GET['id'] ; 

// echo $id ;

try {

    $db =new Sql(); 
    $stmt = $db->prepare("delete from estagiarios where id = :id");
    $stmt->bindValue(":id",$id); 
    $stmt->execute();
    $resposta =['status'=>'ok','msg'=>"Dados Excluidos com Sucesso!"];
    $re_json= json_encode($resposta);
    echo $re_json ; 
    exit();
}catch(\Throwable $e){
    $resposta =['status'=>'fail','msg'=>"ID nao encontrado"];
    $re_json= json_encode($resposta);
    echo $re_json ; 
}
// print_r($resultado);