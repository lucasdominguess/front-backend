<?php 
namespace App\classes;

use PDO;
use DateTime;
use DateTimeZone;
use App\classes\BloquearAcesso;

use App\Application\Actions\User\controlers;
use App\Infrastructure\Persistence\User\Sql;
use App\Application\Actions\User\controlers\LogarAction;

class ConsultaBanco{ 
   
    public function __construct(public string $email,public string $senha)
    {   
        $this->verificarLogin($email,$senha); 
        
    }

    protected function verificarLogin($email,$senha) {
        $dbs =new Sql();
                  
        $stmt = $dbs->prepare("SELECT COUNT(*) AS total FROM tentativa WHERE emails = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['total'];
    
        if ($count >= 3) { 
            
            $block = new BloquearAcesso();
            $block->bloqueio($email,$senha);
            
        }
    }

}



//     protected function bloquear($count,$db,$email){
 
  
//     if ($count == 3) { 
        
//         limparBloqueados($db,$email);
        
//     } else {

//            $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
//            $hr = $datenow->format("y-m-d H:i:s");
          
//            $stmt=$db->prepare("insert into tentativa (email,data) values(:email,:date)") ;
//            $stmt->bindValue(":email",$email);
//            $stmt->bindValue(":date",$hr);
//            $stmt->execute();
//     }
//     }
//     protected function limparBloqueados($db,$email){
            
//     $stmt=$db->prepare("select data from tentativa where email = :email order by `data` desc limit 1;") ;
//     $stmt->bindValue(":email",$email);
//     $stmt->execute();

    
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     $hr = $row['data'];
//     // print_r($hr) ; 
//     // exit();
//     $date = new DateTime($hr);
//     $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    
    
//     $intervalo = $datenow->diff($date);
    
//     $resultado = $intervalo->format("%i");
    

//     if($resultado >= 10 ){ 
      
//         $stmt=$db->prepare("delete from tentativa where email = :email;") ;
//         $stmt->bindValue(":email",$email);
//         $stmt->execute();
//         exit();
//     }
    
        

// }
    


