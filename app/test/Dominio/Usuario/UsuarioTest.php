<?php

use PHPUnit\Framework\TestCase;
use app\Dominio\Usuario\Usuario;

class UsuarioTest extends TestCase
{
    public function testSetAndGetIdUsuario()
    {
        $usuario = new Usuario();
        $usuario->setIdUsuario(1);
        $this->assertEquals(1, $usuario->getIdUsuario());
    }

    public function testSetAndGetNomeUsuario()
    {
        $usuario = new Usuario();
        $usuario->setNomeUsuario('John Doe');
        $this->assertEquals('John Doe', $usuario->getNomeUsuario());
    }

    public function testSetAndGetEmail()
    {
        $usuario = new Usuario();
        $usuario->setEmail('john@example.com');
        $this->assertEquals('john@example.com', $usuario->getEmail());
    }

    public function testSetAndGetIdProfissao()
    {
        $usuario = new Usuario();
        $usuario->setIdProfissao(2);
        $this->assertEquals(2, $usuario->getIdProfissao());
    }

    public function testSetAndGetIdEscolaridade()
    {
        $usuario = new Usuario();
        $usuario->setIdEscolaridade(3);
        $this->assertEquals(3, $usuario->getIdEscolaridade());
    }

    public function testSetAndGetDataNascimento()
    {
        $usuario = new Usuario();
        $dataNascimento = '1990-01-01';
        $usuario->setDataNascimento($dataNascimento);
        $this->assertEquals($dataNascimento, $usuario->getDataNascimento());
    }

    public function testSetAndGetSexo()
    {
        $usuario = new Usuario();
        $usuario->setSexo('M');
        $this->assertEquals('M', $usuario->getSexo());
    }

    public function testSetAndGetIdCidade()
    {
        $usuario = new Usuario();
        $usuario->setIdCidade(4);
        $this->assertEquals(4, $usuario->getIdCidade());
    }

    public function testSetAndGetSenha()
    {
        $usuario = new Usuario();
        $senha = 'password123';
        $usuario->setSenha($senha);
        $this->assertEquals($senha, $usuario->getSenha());
    }

    public function testSetAndGetNivelAcesso()
    {
        $usuario = new Usuario();
        $usuario->setNivelAcesso(5);
        $this->assertEquals(5, $usuario->getNivelAcesso());
    }

    public function testSetAndGetStatusUsuario()
    {
        $usuario = new Usuario();
        $usuario->setStatusUsuario('active');
        $this->assertEquals('active', $usuario->getStatusUsuario());
    }
}
