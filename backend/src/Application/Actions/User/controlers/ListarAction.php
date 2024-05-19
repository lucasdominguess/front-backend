<?php 
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Application\files\ListarDiretorios;
use App\Infrastructure\Persistence\User\ReadRepository;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ListarAction extends Action { 

    protected function action(): response 
    {   
        $db = new Sql();
        $user = new ReadRepository($db);

        // $url =  $_SERVER['HTTP_REFERER'] ?? null ;
        // $url =  $_SERVER['SCRIPT_URI'] ?? null ;
       
        
        if(URI_SERVER == URL_HOMEUSER){ 
            
            $resultado = $user->estagisFindAll();

            return $this->respondWithData($resultado);
           
        }
        if(URI_SERVER == URL_HOMEADM){ 
            
            $resultado = $user->estagisFindAll();

            return $this->respondWithData($resultado);
           
        }
            
        if(URI_SERVER == URL_EXIBIR_ADMIN){
 
            $resultado = $user->admsFindAll();
                
                return $this->respondWithData($resultado);
                // return $this->respondWithData($url);
        }

                
        if(URI_SERVER == URL_TENTA_ACESSO){ 
        $resultado = $user->tentativasFindAll();

        return $this->respondWithData($resultado);
        }
        
        if(URI_SERVER == URL_ARQUIVOS_ADM){
            $pasta = __DIR__ .'/../../../files/arquivos';
            $arquivos = new ListarDiretorios();

            $r =    $arquivos->listar($pasta);
            return $this->respondWithData($r);
       
            
            
        }
    
        return $this->respondWithData(['msg'=>'erro']);
     }
    }
