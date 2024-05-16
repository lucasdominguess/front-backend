<?php
namespace App\Application\Actions\User\controlers;


use ZipArchive;

use App\Application\files\Upload;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface;

class UploadAction extends Action { 

    protected function action(): ResponseInterface
    {
   
      if($_FILES['file']['error'] == 4 ) {
        $msg = ['status' => 'fail', 'msg' => 'Nenhum Arquivo foi enviado!'];
        return $this->respondWithData($msg);
      }
      
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      if(!in_array($ext,['png','jpg','gif','mp4','wmv','csv','txt','pdf']))
      {
        $msg = ['status' => 'fail', 'msg' => 'Formato invalido!'];
        return $this->respondWithData($msg);
      }

      $file = new Upload($_FILES['file']);


        if(in_array($ext, ['png','jpg','gif'])){
          // $pastaArquivos = __DIR__ ."./../../../files/arquivos";
          // $pastaImg = __DIR__ ."./../../../files/arquivos/imagens"; 
            // chmod(__DIR__ ."./../../../files/arquivos",0755);
            // mkdir($pastaArquivos,0755);
          
          $file->upload(__DIR__ ."./../../../files/arquivos/imagens");

        }
        if(in_array($ext, ['pdf','xls'])){
          $file->upload(__DIR__ ."./../../../files/arquivos/planilhas");
        }
        if(in_array($ext, ['csv','txt',''])){
          $file->upload(__DIR__ ."./../../../files/arquivos");
        }

      $msg = ['status' => 'ok', 'msg' => 'Arquivo enviado com sucesso!'];
      return $this->respondWithData($msg);







    }
            
    
     
        // $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // $file = new Upload($_FILES['file']); 
        // $sucesso = $file->upload(__DIR__.'/');
    
        // if($sucesso){
        //     return $this->respondWithData('arquivo enviando com sucesso '.$ext);
        // }
        // if( $ext == 'jpg')
        // {   

            
            
                
                // }

        // }
        
}
