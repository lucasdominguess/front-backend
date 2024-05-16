<?php
namespace App\classes;

use App\Domain\User\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TelegramBotHandler;
use Monolog\Level;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

class CreateLogger {
    
   
    public function logger ($dirname ,$msg, $modo = 'info', array|string $extra = null){
   
        $date = $GLOBALS['days'];
        $logger = new Logger($dirname);

        $logger->pushProcessor(function ($record) use ($extra) { 
            $record["extra"]["server"] = $extra ;
            return $record ;
        });
 
        $logger->pushHandler(new StreamHandler(dirname(__FILE__)."/../../logs/logs".$date.".csv"));
        $logger->$modo($msg);
}
    public function logTelegran(array|string $extra = null){
        $logger = new Logger('TelegranBot');
        
        $logger->pushProcessor(function ($record) use ($extra) { 
            $record["extra"]["server"] = $extra ;
            return $record ;
        });
    

        $logger->pushHandler( new TelegramBotHandler(
            apiKey:"6896066213:AAEfj5TxiJaH6m2CEsP9fJZh3BUvpPfypzw",
            channel:"@phpAplicationweb",
            level:Level::Warning
    ));
        $logger->warning('Administrador '.$_SESSION[User::USER_NAME].  ' efetuou login');
    

} 
 

}