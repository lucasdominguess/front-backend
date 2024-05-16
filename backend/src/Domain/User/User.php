<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\classes\Data;
use DateTime;
use JsonSerializable;

class User implements JsonSerializable
{
    const USER_ID = 'user_id';
    const USER_EMAIL = 'email';
    const USER_NAME = 'user_nome';
    const USER_NIVEL = 'nivel' ; 
    const USER_DATE = 'datasessao'; 

    public function __construct(public readonly int $id_adm,public string $nome,public string $email,public int|string $nivel )
    {

    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'user_id' => $this->id_adm,
            'user_nome' => $this->nome,
            'email' => $this->email,
            'nivel' => $this->nivel,
            // 'datasessao' => $this->data,
        ];

       
    }
}
