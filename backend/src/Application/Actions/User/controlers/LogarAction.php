<?php
namespace App\Application\Actions\User\controlers;

use App\Infrastructure\Helpers;
use PDO;
use App\classes\Token;
use App\Domain\User\User;
use App\classes\CreateLogger;
use App\classes\BloquearAcesso;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql;
use App\Infrastructure\Persistence\User\RedisConn;
use Psr\Http\Message\ResponseInterface as Response; 


class LogarAction extends UserAction
{
    protected function action(): Response
    {  
      
         //criando instancia de logger 
         $logger = new CreateLogger();

        
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

       
        
        try{

            $db = new Sql();
        }catch(\PDOException $e){ 
            $response = (['status'=>'fail','msg'=> $e->getMessage()]);
            $logger->logger('Erro Sql', "Erro ao conectar no Banco de dados",'warning'); 
            return $this->respondWithData($response);
        }

        // Verificando se Email e senha estao em branco 
        if($email == null || $senha == null)
        {
            $response = ['status' => 'fail', 'msg' => 'Usuario ou Senha não podem estar vazios'];
            return $this->respondWithData($response);
        }
        // verificando se o padrao de email capturado é valido
        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email))
        {   //Regex para validar formado de nome com min. de 3
            $response= (['status' => 'fail', 'msg' => 'Email Inválido!']);
            return $this->respondWithData($response);
            // exit();
        }

          

    // Verificando se email e senha correspondem a um cadastro valido 
    $stmt=$db->prepare("Select * from usuarios where email = :email");
    $stmt->bindValue(":email",$email);
    $stmt->execute();
   
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!isset($retorno[0]['id_adm'])||!password_verify($senha,$retorno[0]['senha']))
            {   
                $block = new BloquearAcesso($email,$db); 

                $res=$block->bloqueio($email,$db);
                


                switch ($res){ 
                    case $res === 1 : 
                        $response= (['status'=>'fail','msg'=>'Usuario ou Senha invalida']);
                        return $this->respondWithData($response);
                        // break;
                      

                    case $res === 2 : 
                        $response= (['status'=>'fail','msg'=>'Acesso Negado Aguarde 10 minutos']);
                        return $this->respondWithData($response);
                        // break;

                // endswitch;
                }
               
            }   
                 //criando instancia do redis e verifica se ja existe usuario logado 
                try {
                  
                    $redis = new RedisConn(); 
                    $redis_user = $redis->hget($email,'email'); 
                } catch (\Throwable $e) {
                    $logger->logger('Erro Redis','Erro ao conectar em Redis','warning');
                    $response = (['status'=>'fail','msg'=> $e->getMessage()]);
                    return $this->respondWithData($response);
                }
                    if($redis_user){
                        $response= (['status'=>'fail','msg'=>'Usuario ja esta logado']);
                        $logger->logger("Duplicidade de Sessão","Tentativa de multiplos acessos $email " ,'warning',IP_SERVER);
                        return $this->respondWithData($response);
                    }
                    // }
      
                //criando dados do User 
                $user = new User($retorno[0]['id_adm'],$retorno[0]['nome'],$retorno[0]['email'],$retorno[0]['nivel']);
                

                $_SESSION[User::USER_ID]=$user->id_adm;
                $_SESSION[User::USER_NAME]=$user->nome;
                $_SESSION[User::USER_EMAIL]=$user->email;
                $_SESSION[User::USER_NIVEL]=$user->nivel;
                // $_SESSION[User::USER_DATE]=$user->data;
                // $_SESSION['datasessao']=$::USER_EMAIL;

     
                // gerando loggers 
                // $logger->loggerProcessor();
                $logger->logger("LOGIN",'Usuario: '.$_SESSION[User::USER_NAME].' Realizou Login ','info',IP_SERVER);
                // $logger->logTelegran($_SESSION);
                
                // criando token do usuario
                $token = new Token($_SESSION[User::USER_NAME]);

               
                //criando instancia do redis e key fild do usuario 
                $redis = new RedisConn(); 
                $redis->hset($_SESSION[User::USER_EMAIL], 'name',$_SESSION[User::USER_NAME]);
                $redis->hset($_SESSION[User::USER_EMAIL], 'email',$_SESSION[User::USER_EMAIL] );
                $redis->hset($_SESSION[User::USER_EMAIL], 'nivel',$_SESSION[User::USER_NIVEL] );
                $redis->expire($_SESSION[User::USER_EMAIL], 3600);


                

                $response= ['status'=>'ok','msg'=>'logado com sucesso','location'=>'/sender'];

                return $this->respondWithData($response);



    }
  
}