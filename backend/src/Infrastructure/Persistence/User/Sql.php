<?php
namespace App\Infrastructure\Persistence\User;
// namespace App\Infrastructure\Persistence\User;
// namespace App\Infrastructure\Persistence\User ; 

    class Sql extends \PDO
    {   
        public function __construct() {
            global $env;
            parent::__construct("{$env['sgbd']}:dbname={$env['dbname']};host={$env['host']}",$env['user'],$env['password']);
            // parent::__construct("mysql:dbname={$env['dbname']};host={$env['host']}",$env['user'],$env['password']);
        }
        
        public function setParms(\PDOStatement $stmt , array $dados = []){ 
            
            foreach ($dados as $key => $value) {
                $stmt->bindValue($key,$value);
            }
        }
        
    }
