<?php

use PHPUnit\Framework\TestCase;
use App\Dominio\Questionario\Questionario;
use App\Dominio\Usuario\Usuario;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Url\Url;

class QuestionarioTest extends TestCase
{
    private Questionario $questionario;

    protected function setUp(): void
    {
        $this->questionario = new Questionario();
    }

    public function testSetAndGetIdQuestionario()
    {
        $this->questionario->setIdQuestionario(1);
        $this->assertEquals(1, $this->questionario->getIdQuestionario());
    }

    public function testSetAndGetTitulo()
    {
        $titulo = "Pesquisa de Satisfação";
        $this->questionario->setTitulo($titulo);
        $this->assertEquals($titulo, $this->questionario->getTitulo());
    }

    public function testSetAndGetDescricao()
    {
        $descricao = "Avaliação de serviços.";
        $this->questionario->setDescricao($descricao);
        $this->assertEquals($descricao, $this->questionario->getDescricao());
    }

    public function testSetPadraoComValorInvalido()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Informes valores válidos!");
        $this->questionario->setPadrao(2);
    }

    public function testSetPadraoComValorValido()
    {
        $this->questionario->setPadrao(1);
        $this->assertEquals(1, $this->questionario->getPadrao());
    }

    public function testSetStatusComValorInvalido()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Informe um status válido!");
        $this->questionario->setStatus("X");
    }

    public function testSetStatusComValorValido()
    {
        $this->questionario->setStatus("A");
        $this->assertEquals("A", $this->questionario->getStatus());
    }

    public function testSetTipoComValorInvalido()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Informe um tipo válido!");
        $this->questionario->setTipo("X");
    }

    public function testSetTipoComValorValido()
    {
        $this->questionario->setTipo("Q");  // Ajustado para maiúscula
        $this->assertEquals("Q", $this->questionario->getTipo());
    }
    

    public function testSetAndGetProfissao()
    {
        $profissao = $this->createMock(Profissao::class);
        $this->questionario->setProfissao($profissao);
        $this->assertSame($profissao, $this->questionario->getProfissao());
    }

    public function testSetAndGetEscolaridade()
    {
        $escolaridade = $this->createMock(Escolaridade::class);
        $this->questionario->setEscolaridade($escolaridade);
        $this->assertSame($escolaridade, $this->questionario->getEscolaridade());
    }

    public function testSetAndGetUrl()
    {
        $url = $this->createMock(Url::class);
        $this->questionario->setUrl($url);
        $this->assertSame($url, $this->questionario->getUrl());
    }
}
