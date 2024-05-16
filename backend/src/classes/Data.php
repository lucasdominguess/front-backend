<?php

namespace App\classes;
use DateTime;
use DateTimeZone;

class Data
{
    private DateTime $data;

    public function __construct(string $data)
    {
        $this->setData($data);
    }

    private function setData(string $data): void
    {
        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/im",$data)) {
            // print_r("aqui print ".$data);
            throw new \Exception("Erro! Formato de data invalida.");
        }



        $this->data = new DateTime($data);
        
    }

    public function getData(): DateTime
    {   
        return $this->data;
    }
}

// $data1 = new DateTime($this->data);
// $data2 = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
// $dataform = $data2->format("Y-m-d");



// var_dump($data1);
