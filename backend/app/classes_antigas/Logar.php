<?php 
require 'ConsultaBanco.php';
require_once 'Sql.php' ; 
require 'VerificarLogin.php';
require 'VerificarEmail.php';

$email = $_POST['email']; 
$senha = $_POST['senha']; 

$db = new Sql(); 

try{ 
    $ver_email = new VerificarEmail($email);
    $newEmail = new ConsultaBanco($email,$senha); 

    $login = new VerificarLogin();
}catch(\Throwable $e){ 
    echo $e->getMessage();
}

function bloqueio($email,$senha){

    $db5 = new Sql(); 


    $stmt = $db5->prepare("SELECT COUNT(*) AS total FROM tentativa WHERE email = :email");
    $stmt->bindValue(":email", $email);
    $stmt->execute();


    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $row['total'];



    // limparbloqueados($email);
    if ($count >= 3) { 
        // $res =json_encode(['status'=>'fail','msg'=>'Acesso Negado']);
        // echo $res ;
        limparbloqueados($email,$senha);
        
    } else {
           $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
           $hr_bloq = date_add($datenow,date_interval_create_from_date_string('+1 minutes'));
           $hr = $hr_bloq->format("y-m-d H:i:s");
           $stmt=$db5->prepare("insert into tentativa (email,data) values(:email,:date)") ;
           $stmt->bindValue(":email",$email);
           $stmt->bindValue(":date",$hr);
           $stmt->execute();
    }
    
}
function limparbloqueados($email,$senha){
    $db3 = new Sql(); 

    $stmt=$db3->prepare("select data from tentativa where email = :email order by `data` desc limit 1;") ;
    $stmt->bindValue(":email",$email);
    $stmt->execute();

    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $hr = $row['data'];    //retorna tempo de ultimo registro do usuario bloqueado 2024-03-22 08:44:59
  

    $ultimo_registro = new DateTime($hr);//convertendo hora do ultimo registro para Datetime 
    $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo')); //data de agora 
    
    
    // $intervalo = $datenow->diff($date);
    // $hr_bloq = date_add($ultimo_registro,date_interval_create_from_date_string('+10 minutes'));
    // $newtime = $addtime2->format('Y-m-d H:i:s');
    // print_r($hr_bloq);
    // $resultado = $intervalo->format("%i");
    //  $databanco = $date->format("Y-m-d H:i:s");

    $newdate_now = $datenow->format('Y-m-d H:i:s');
    $newhr_bloq = $ultimo_registro->format('Y-m-d H:i:s');

    // echo "mostrando hora do banco .$newhr_bloq \n"; 
    // echo "hr de agora .$newdate_now \n"; 
    // exit();
    // echo "$newtime \n" ; 
    // var_dump($databanco);    
    

     if($newdate_now < $newhr_bloq ){   //verificando se a data de agora é maior que a do ultimo registro no banco
         
        $addtime = date_add($ultimo_registro,date_interval_create_from_date_string('+10 minutes'));
        $newtime = $addtime->format('Y-m-d H:i:s');
       
    
        
    
    
       
        $stmt=$db3->prepare("update tentativa set data = :data where email = :email ") ;
        $stmt->bindValue(":email",$email);
        $stmt->bindValue(":data",$newtime);
        $stmt->execute();
        $res =json_encode(['status'=>'fail','msg'=>'Acesso Negado Aguarde 10 minutos ']);
        echo $res ; 
        exit();


        // exit();
    }
    // $hr->format('Y-m-d H:i:s');
    
            $stmt=$db3->prepare("delete from tentativa where email = :email;") ;
            $stmt->bindValue(":email",$email);
            $stmt->execute();
           

}
