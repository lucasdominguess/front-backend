<?php
namespace tests\Application\Actions\User;

use PHPUnit\Framework\TestCase;





class SomarTest extends TestCase
{
    public function testSoma()
    {
        $resultado = 1 + 2;
        $this->assertEquals(3, $resultado);
    }
}
