<?php

use PHPUnit\Framework\TestCase;
use App\Dominio\Usuario\Usuario;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Escolaridade;

class UsuarioTest extends TestCase
{
    private Usuario $usuario;

    protected function setUp(): void
    {
        $this->usuario = new Usuario();
    }

    public function testSetAndGetIdUsuario()
    {
        $this->usuario->setIdUsuario(1);
        $this->assertEquals(1, $this->usuario->getIdUsuario());
    }

    public function testSetAndGetNomeUsuario()
    {
        $nome = "João Silva";
        $this->usuario->setNomeUsuario($nome);
        $this->assertEquals($nome, $this->usuario->getNomeUsuario());
    }

    public function testSetAndGetEmail()
    {
        $email = "joao@example.com";
        $this->usuario->setEmail($email);
        $this->assertEquals($email, $this->usuario->getEmail());
    }

    public function testSetAndGetProfissao()
    {
        $profissao = $this->createMock(Profissao::class);
        $this->usuario->setProfissao($profissao);
        $this->assertSame($profissao, $this->usuario->getProfissao());
    }

    public function testSetAndGetEscolaridade()
    {
        $escolaridade = $this->createMock(Escolaridade::class);
        $this->usuario->setEscolaridade($escolaridade);
        $this->assertSame($escolaridade, $this->usuario->getEscolaridade());
    }
}
