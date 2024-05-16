<?php 
session_start();

class SalvarLogs{ 
    
    protected $data; 
    

    public function __construct(protected $conteudo_arquivo)
    {   
        $this->data =  new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $nome_arquivo = $this->data->format('Y-m-d');
        $hr_arquivo = $this->data->format('Y-m-d H:i:s');
        $new = fopen("./logs/log_".$nome_arquivo.".csv", 'a+'); //w+ permissao para ler e escrever
        $this->registrarLogin($new ,$conteudo_arquivo);
       
    }


     protected function registrarLogin($new ,$conteudo_arquivo){
    
           fwrite($new,$conteudo_arquivo.' ');
        // fclose($new);
    }

  
} 
