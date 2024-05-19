<?php 
namespace App\Application\Actions\User\controlers;
// session_start();
// if($_SESSION["email"] == null){
//     header('location: http://192.168.206.39:9000');
//     session_destroy(); 
//     $res = ['status'=>'ok','msg'=>'Sessao encerrada com sucesso'];  
//     echo json_encode($res);
// }

use DateTime;

use Slim\App;
use DateTimeZone;
use App\Domain\User\User;
use App\classes\CreateLogger;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\RedisConn;
use Psr\Http\Message\ResponseInterface as Response;

class SairSessaoAction extends UserAction 
{ 
    protected function action(): Response 
    {   
        
        $this->createLogger->logger("LOGOUT",'Usuario: '.$_SESSION[User::USER_NAME].' Desconectou','info'); 
        $this->redisConn->del($_SESSION[User::USER_EMAIL]);
        
        setcookie('token','',-1,'/');
        session_unset();
        session_destroy();

        $response= ['status'=>'ok','msg'=>'Sessao encerrada com sucesso','location'=>'/'];
        return $this->respondWithData($response);
    }
    



}




// $_SESSION['sessao'];
// $addtime = date_add($_SESSION['sessao'],date_interval_create_from_date_string('+30 minutes'));
// $sessao_usuario = $addtime->format('Y-m-d H:i:s');
// $datenow =  new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

// $_SESSION['tempo30'] = $sessao_usuario ; 

// if($sessao_usuario<$datenow){ 
//     session_unset();
//     session_destroy();  
//     header('location: http://192.168.206.39:9000');
//     $res = ['status'=>'fail','msg'=>'Tempo de Sessao expirada!'];  
//     echo json_encode($res);
// }

// session_destroy(); 
// $res = ['status'=>'ok','msg'=>'Sessao encerrada com sucesso'];  
// echo json_encode($res);
// echo session_id();
// echo "<br>";
// echo session_save_path(); 

// session_unset();
