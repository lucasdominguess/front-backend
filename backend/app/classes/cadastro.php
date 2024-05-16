<?php 

session_start();
$id_adm = $_SESSION['id'];
$nomeAdm = $_SESSION['nome'];

require 'Sql.php';
require 'Estagiario.php';
require 'Data.php';

$nome = $_POST['nome'];
$data = $_POST['data_nascimento'];
$idN = $_POST['id'];
// print_r("print_r id aqui é = ".$_POST['id']);

try {
    $newdata = new Data($data);
    $cad = new Estagiario($nome,$newdata);
  
} catch (\Throwable $th) {

    $resposta =['status'=>'fail','msg'=>$th->getMessage()];
    $re_json= json_encode($resposta);
    echo $re_json ; 
   
    exit();
}
// tratando id recebido em post 
$primarykey = $_POST['id'] == '' ? null : $_POST['id'];

$db = new Sql();                                    
$stmt=$db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
$var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
$db->setParms($stmt,$var);

// metodo antigo de inserir dados;
// $stmt->bindValue(":nome",$cad->nome);
// $stmt->bindValue(":data",$cad->data->getData()->format("Y-m-d"));

try { 
     $stmt->execute();
}catch(\Throwable $th) { //erro caso nome ja esteja cadastrado
    if($stmt->errorCode()=='23000'){
        $resposta =['status'=>'fail','msg'=>"O mesmo nome nao pode ser inserido"];
        $re_json= json_encode($resposta);
        echo $re_json ; 
        exit();
    }


    
}
//ira lançar uma response pro front apos passar toda validação 
$resposta =['status'=>'ok','msg'=>"Cadastro realizado!"];
$re_json= json_encode($resposta);
echo $re_json ; 
