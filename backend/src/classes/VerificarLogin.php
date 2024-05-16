<?php
namespace App\classes;


use DateTime;
use DateTimeZone;
use App\classes\Token;
use App\classes\BloquearAcesso;
use phpDocumentor\Reflection\Types\This;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as response;

class VerificarLogin { 

public function __construct($email,$senha) {
   $this->validarLogin($email,$senha);
}

    protected function validarLogin($email,$senha)
    {
        // $email = $_POST['email']; 
        // $senha = $_POST['senha']; 

        $db2 = new Sql();
        $stmt=$db2->prepare("Select * from usuarios where email = :email");
        $stmt->bindValue(":email",$email);
        $stmt->execute();

        $retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if(!isset($retorno[0]['id_adm'])){
        sleep(1);
        $block = new BloquearAcesso; 
        $block->bloqueio($email,$senha);
    
        
        $response = ['status'=>'fail','msg'=>'Usuario ou Senha invalida'];
        // echo json_encode($response) ;
        return $response;

        exit(); 

    }
    if(!password_verify($senha,$retorno[0]['senha'])){
        sleep(1);
        $block_senha = new BloquearAcesso; 
        $block_senha->bloqueio($email,$senha);
    
        $response =['status'=>'fail','msg'=>'Usuario ou Senha invalida']; 
        // echo json_encode($response) ;
        return $response;
        exit();
    }

    // // Iniciar sessão 
    // session_start();
    // $_SESSION['id_usuario']= $retorno[0]['id_adm'];
    // $_SESSION['email']= $retorno[0]['email'];
    // $_SESSION['id']= $retorno[0]['id_adm'];
    // $_SESSION['nome']= $retorno[0]['nome'];
    // $_SESSION['sessao'] = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    // $hr_arquivo =$_SESSION['sessao']->format('Y-m-d H:i:s');
    // $_COOKIE['token'] = new Token($_SESSION['email']);
    // $_SESSION['token'] =  new Token($_SESSION['email']);
    // $r= new SalvarLogs($_SESSION['token']);

    // echo json_encode(['status'=>'ok','msg'=>'logado com sucesso','nome'=>$retorno[0]['nome']]);


    // $conteudo = array ($_SESSION['id_usuario'],$_SESSION['email'],$_SESSION['nome'],$hr_arquivo);

    // for ($i = 0 ; $i < count($conteudo);$i++){ 
    //     $a1 = new SalvarLogs($conteudo[$i]) ; 
    
    // }
    //     $a2 = new SalvarLogs("\n");

}    
}
