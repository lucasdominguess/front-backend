<?php
namespace App\Application\Actions\sender;



use Slim\Psr7\Response;
use App\Domain\User\User;

final class HandleSenderAction extends SenderAction
{
    protected function Action():Response
    { 
        $name = $_SESSION[User::USER_NAME]; 
        $id_adm = $_SESSION[User::USER_ID]; 
        
        if (!isset($_SESSION[User::USER_ID])) {
      
            return $this->response->withHeader("Location","/")->withStatus(302);
        }


        if($name == 'root' || $id_adm == 4){
            return $this->response->withHeader("Location","/admin/home_adm")->withStatus(302);
        }
         return $this->response->withHeader("Location","/user/home_user")->withStatus(302);
    }
}