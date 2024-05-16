<?php

use PHPUnit\Framework\TestCase;
use App\classes\Pessoa;

class PessoaTest extends TestCase
{
    public function testConstrutorComNomeInvalido()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Erro! Nome invalido.");
        new Pessoa('12');
    }

    public function testConstrutorComNomeValido()
    {
        $pessoa = new Pessoa('lucas');
        $this->assertInstanceOf(Pessoa::class, $pessoa);
    }
}
