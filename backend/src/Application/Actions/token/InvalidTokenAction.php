<?php
namespace App\Application\Actions\Token;
use Slim\Psr7\Response;
use App\Application\Actions\Token\TokenAction;


final class InvalidTokenAction extends TokenAction
{
    protected function action(): Response
    {
        $res = ['cod'=>'fail','msg'=>'Token inválido'];
        return $this->respondWithData($res);
    }
}
