<?php
namespace App\Application\Middleware;
 

use DateTime;
use DateTimeZone;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Domain\User\User;
use App\Infrastructure\Helpers;
use App\Infrastructure\Persistence\User\RedisConn;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
 
 
class TokenMiddleware {
    public function __invoke(Request $request, RequestHandler $handler)
    {  
        global $env;
        $key = $env['secretkey'];
        $response = new Response();
        // $tokenAuth = $_SERVER['HTTP_AUTHORIZATION'] ?? 'tokennaoexiste' ;
        // Helpers::dd($tokenAuth);
        
        $msg = json_encode(['status' => 'fail', 'msg' => 'Sessão Expirada']);

        if(!isset($_COOKIE['token'])){
            setcookie('token','',-1,'/');
            session_unset();
            session_destroy();
            // return $response->withHeader('Location', '/?msg=' . urlencode($msg))->withStatus(302);   
            return $response->withHeader('Location', '/')->withStatus(302); 
        }

        $email = $_SESSION[User::USER_EMAIL];

        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
    
        $inicia_time = $decoded_array['iat'];  //tempo do inicio criação token
        $exp_sessao = $decoded_array['exp'];  //tempo de expiração do token 
        
        // $Hrexp =$exp_sessao->format('H:i:s');
        // define('TOKEN_EXP',$exp_sessao);

        $inicia_time_new=date("Y-m-d H:i:s",$inicia_time);
      
    
    
        $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo')); 
        $newdate_now = $datenow->format('Y-m-d H:i:s');

        // $_SESSION['EXP_TOKEN'] = $exp_sessao ;
        // echo $newdate_now ;
        // echo $exp_sessao;
        
        if($newdate_now <= $exp_sessao) 
        { 
            // header('location: /');
            
                        $response = $handler->handle($request);
                        // $response= $tokenAuth;
                        return $response;
        }
        $redis = new RedisConn(); 
        $redis->del($_SESSION[User::USER_EMAIL]);
        setcookie('token','',-1,'/');
        session_destroy();
     
        

                // Defina a mensagem

        // Redirecione o cliente e inclua a mensagem na URL como um parâmetro de consulta
        // return $response->withHeader('Location', '/?msg=' . urlencode($msg))->withStatus(302);



        
        return $response->withHeader('Location', '/')->withStatus(302); 
        // return $resposta;

        }
        
       
        }

            

    



