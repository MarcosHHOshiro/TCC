<?php

use PHPUnit\Framework\TestCase;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Dominio\Url\Url;
use App\Dominio\Usuario\Usuario;
use DB\DataBase;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RepositorioDeQuestionarioComPdoTest extends TestCase
{
    private $mockDataBase;
    private $repositorio;

    protected function setUp(): void
    {
        // Mock da classe DataBase para evitar a conexão real com o banco
        $this->mockDataBase = $this->createMock(DataBase::class);
        
        // Cria uma instância de RepositorioDeQuestionarioComPdo com o mock de DataBase
        $this->repositorio = new RepositorioDeQuestionarioComPdo($this->mockDataBase);
    }

    public function testCadastrar()
    {
        $questionario = $this->createMock(Questionario::class);
        $usuario = $this->createMock(Usuario::class);
        $url = $this->createMock(Url::class);

        // Define os valores de retorno dos métodos do objeto Questionario
        $questionario->method('getTitulo')->willReturn('Título Teste');
        $questionario->method('getDescricao')->willReturn('Descrição Teste');
        $questionario->method('getUsuario')->willReturn($usuario);
        $questionario->method('getPadrao')->willReturn(true);
        $questionario->method('getDataInicio')->willReturn('2023-01-01');
        $questionario->method('getDataFim')->willReturn('2023-12-31');
        $questionario->method('getStatus')->willReturn('A');
        $questionario->method('getTipo')->willReturn('Q');
        $questionario->method('getProfissao')->willReturn((object)['getIdProfissao' => 1]);
        $questionario->method('getUrl')->willReturn($url);
        $questionario->method('getEscolaridade')->willReturn((object)['getIdEscolaridade' => 2]);

        $usuario->method('getIdUsuario')->willReturn(10);
        $url->method('getIdUrl')->willReturn(20);

        // Configura o mock para o método insert, simulando o retorno de um ID
        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_questionario');

        $this->mockDataBase->expects($this->once())
            ->method('insert')
            ->with([
                'titulo' => 'Título Teste',
                'descricao' => 'Descrição Teste',
                'id_usuario_criou' => 10,
                'padrao' => true,
                'data_inicio' => '2023-01-01',
                'data_fim' => '2023-12-31',
                'status' => 'A',
                'tipo' => 'Q',
                'id_profissao' => 1,
                'id_url' => 20,
                'id_escolaridade' => 2
            ])
            ->willReturn(100);

        // Executa o método de cadastro e verifica o ID retornado
        $idQuestionario = $this->repositorio->cadastrar($questionario);
        $this->assertEquals(100, $idQuestionario);
    }

    public function testCadastrarPerguntas()
    {
        $pergunta = $this->createMock(Perguntas::class);
        $questionario = $this->createMock(Questionario::class);

        // Define os valores de retorno dos métodos de Perguntas
        $pergunta->method('getDescricao')->willReturn('Pergunta Teste');
        $pergunta->method('getJustificativa')->willReturn('Justificativa Teste');
        $pergunta->method('getQuestionario')->willReturn($questionario);
        
        $questionario->method('getIdQuestionario')->willReturn(100);

        // Configura o mock para o método insert
        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_perguntas');

        $this->mockDataBase->expects($this->once())
            ->method('insert')
            ->with([
                'descricao' => 'Pergunta Teste',
                'justificativa' => 'Justificativa Teste',
                'id_questionario' => 100
            ])
            ->willReturn(200);

        // Executa o método de cadastro de perguntas e verifica o ID retornado
        $idPergunta = $this->repositorio->cadastrarPerguntas($pergunta);
        $this->assertEquals(200, $idPergunta);
    }

    public function testPegaIdUsuarioLogado()
    {
        $headers = [
            'Authorization' => 'Bearer token_simulado'
        ];
        
        // Mock JWT para simular a decodificação
        JWT::$leeway = 1; // Adiciona tolerância ao tempo
        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_usuario');
        
        $this->mockDataBase->expects($this->once())
            ->method('selectJoinPersonalizavel')
            ->with('login = ?', 'id_usuario', null, null, ['usuario_teste'], null)
            ->willReturn($this->createConfiguredMock(PDOStatement::class, [
                'fetchColumn' => 50
            ]));

        // Configura o JWT de forma que decode() retorne um objeto com login para evitar mock direto
        $this->repositorio->pegaIdUsuarioLogado($headers);
    }

    public function testUpdateQuestionario()
    {
        $questionario = $this->createMock(Questionario::class);
        $questionario->method('getTitulo')->willReturn('Novo Título');
        $questionario->method('getDescricao')->willReturn('Nova Descrição');
        $questionario->method('getDataFim')->willReturn('2025-12-31');
        $questionario->method('getStatus')->willReturn('A');
        $questionario->method('getPadrao')->willReturn(true);

        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_questionario');

        $this->mockDataBase->expects($this->once())
            ->method('update2')
            ->with('id_questionario = ?', [
                'titulo' => 'Novo Título',
                'descricao' => 'Nova Descrição',
                'data_fim' => '2025-12-31',
                'status' => 'A',
                'padrao' => true
            ], [1]);

        $this->repositorio->updateQuestionario($questionario, 1);
    }
}
