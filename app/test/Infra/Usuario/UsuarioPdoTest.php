<?php

use PHPUnit\Framework\TestCase;
use App\Infra\Usuario\UsuarioPdo;
use App\Dominio\Usuario\Usuario;
use Db\DataBase;
use PDO;

class UsuarioPdoTest extends TestCase
{
    private $mockDataBase;
    private $usuarioPdo;

    protected function setUp(): void
    {
        // Cria um mock da classe DataBase para evitar a conexão real com o banco
        $this->mockDataBase = $this->createMock(DataBase::class);
        $this->usuarioPdo = new UsuarioPdo($this->mockDataBase);
    }

    public function testCadastro()
    {
        $usuario = $this->createMock(Usuario::class);
        
        // Configura o objeto usuário para retornar valores de teste
        $usuario->method('getNomeUsuario')->willReturn('João Silva');
        $usuario->method('getEmail')->willReturn('joao@example.com');
        $usuario->method('getProfissao')->willReturn((object) ['getIdProfissao' => 1]);
        $usuario->method('getEscolaridade')->willReturn((object) ['getIdEscolaridade' => 2]);
        $usuario->method('getDataNascimento')->willReturn('1990-01-01');
        $usuario->method('getSexo')->willReturn('M');
        $usuario->method('getLogin')->willReturn('joaosilva');
        $usuario->method('getSenha')->willReturn('senhaSegura');
        $usuario->method('getPermitido')->willReturn(true);
        $usuario->method('getPermissao')->willReturn('U');
        $usuario->method('getStatusUsuario')->willReturn('A');
        $usuario->method('getEstado')->willReturn('SP');
        $usuario->method('getCidade')->willReturn('São Paulo');

        // Configura o mock para o método insert e define o ID retornado como 1
        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_usuario');

        $this->mockDataBase->expects($this->once())
            ->method('insert')
            ->with([
                'nome_usuario' => 'João Silva',
                'email' => 'joao@example.com',
                'id_profissao' => 1,
                'id_escolaridade' => 2,
                'data_nascimento' => '1990-01-01',
                'sexo' => 'M',
                'id_cidade' => null,
                'login' => 'joaosilva',
                'senha' => 'senhaSegura',
                'permitido' => true,
                'permissao' => 'U',
                'status_usuario' => 'A',
                'estado' => 'SP',
                'cidade' => 'São Paulo',
            ])
            ->willReturn(1);

        // Executa o método cadastro e verifica se o ID retornado é o esperado
        $idUsuario = $this->usuarioPdo->cadastro($usuario);
        $this->assertEquals(1, $idUsuario);
    }

    public function testConsulta()
    {
        // Configura o mock para setTable e selectJoinPersonalizavel
        $this->mockDataBase->expects($this->once())
            ->method('setTable')
            ->with('tb_usuario');

        $this->mockDataBase->expects($this->once())
            ->method('selectJoinPersonalizavel')
            ->willReturn($this->createConfiguredMock(PDOStatement::class, [
                'fetchAll' => [
                    [
                        'id_usuario' => 1,
                        'nome_usuario' => 'João Silva',
                        'email' => 'joao@example.com',
                        'data_nascimento' => '1990-01-01',
                        'sexo' => 'M',
                        'login' => 'joaosilva',
                        'status_usuario' => 'A',
                        'id_profissao' => 1,
                        'id_escolaridade' => 2,
                        'id_cidade' => null,
                        'permissao' => 'U',
                        'cidade' => 'São Paulo',
                        'estado' => 'SP'
                    ]
                ]
            ]));

        $resultado = $this->usuarioPdo->consulta();

        $this->assertEquals([
            [
                'id_usuario' => 1,
                'nome_usuario' => 'João Silva',
                'email' => 'joao@example.com',
                'data_nascimento' => '1990-01-01',
                'sexo' => 'M',
                'login' => 'joaosilva',
                'status_usuario' => 'A',
                'id_profissao' => 1,
                'id_escolaridade' => 2,
                'id_cidade' => null,
                'permissao' => 'U',
                'cidade' => 'São Paulo',
                'estado' => 'SP'
            ]
        ], $resultado);
    }
}
