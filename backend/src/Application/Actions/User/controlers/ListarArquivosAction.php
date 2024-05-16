<?php 
namespace App\Application\Actions\User\controlers;
use Slim\Psr7\Response;
use App\Application\Actions\Action;
use App\Application\files\ListarDiretorios;

class ListarArquivosAction extends Action 
{


    public function action() : Response
    {
        $pasta = __DIR__ .'/../../../files/arquivos';
        $arquivos = new ListarDiretorios();
        $namePasta = $_GET['name'] ?? ''; 
          

          if($namePasta == 'imagens'){
            $r =    $arquivos->listar($pasta."/imagens");
            return $this->respondWithData($r);
        }
          if($namePasta == 'planilhas'){
            $c=__DIR__ .'/../../../files/arquivos/planilhas';
            $r =    $arquivos->listar($c);
            return $this->respondWithData($r);
            
        }
        


      return $this->respondWithData(['erro'=>$_GET['name']]);
    
    }
}
