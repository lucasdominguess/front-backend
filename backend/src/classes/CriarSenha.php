<?php 
namespace App\classes;

class CriarSenha{ 

    public function __construct(public $senha){ 
        $this->criptografarSenha($senha); 
    }


    public function criptografarSenha($senha){ 

        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT); 
        return $senhaCriptografada;
    }
}