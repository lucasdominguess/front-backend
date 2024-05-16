<?php
namespace App\Infrastructure\Persistence\User;


use Redis;
use App\Domain\User\User;

class RedisConn extends \Redis
{      
    private string $host;
    private int $port;
    function __construct()
    {  
         
        $config = parse_ini_file(__DIR__.'/../../../../config.ini', true);
        
        $this->host = $config['redis']['redis_host'];
        $this->port =$config['redis']['redis_port'];
        $this->connect($this->host, $this->port);
    }

    
}



// $redisUser = new RedisConn();
// $redisUser->hset('user','nome','rodrigo o bruxo do front-end');

// $redisUser->hset('animal','raça','dog caramelo');
// hget estagiario nomes

//    $redisUser->hset('Usuario', 'nome',$_SESSION[User::USER_NAME] , 'email', $_SESSION[User::USER_EMAIL] , 'nivel', $_SESSION[User::USER_NIVEL]); 