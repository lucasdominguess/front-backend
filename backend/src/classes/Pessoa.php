<?php 

namespace App\classes;

class Pessoa { 

    public function __construct(public string $nome) //alterar string para DateTime
    {
        $this->validaNome();
      
    }
    private function validaNome():void {
        
         if (!preg_match("/^[a-zàáâãçèéêìíîòóôõùúû'\s]{3,}$/im",$this->nome)) {   //Regex para validar formado de nome com min. de 3
        throw new \Exception("Erro! Nome invalido."); 
      }
     
    }
   
    // private function validaData():void { //criar classe para validar data

    //     if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/im", $this->data)) {     //Regex para validar formato YYYY-MM-DD
    //        throw new Exception("Erro! Formato de data inválida.");  
           
    //     }
    //     $this->validaRegra();
    // }

   
}