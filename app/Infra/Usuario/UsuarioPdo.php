<?php

namespace App\Infra\Usuario;

use app\Dominio\Usuario\Usuario;
use Db\DataBase;
use Exception;
use PDO;

class UsuarioPdo
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function cadastro(Usuario $obUsuario): int
    {
        $this->db->setTable("tb_usuario");
        $id_historico = ($this->db)->insert([
            'nome_usuario' => $obUsuario->getNomeUsuario(),
            'email' => $obUsuario->getEmail(),
            'id_profissao' => $obUsuario->getProfissao()->getIdProfissao(),
            'id_escolaridade' => $obUsuario->getEscolaridade()->getIdEscolaridade(),
            'data_nascimento' => $obUsuario->getDataNascimento(),
            'sexo' => $obUsuario->getSexo(),
            'id_cidade' => null,
            'login' => $obUsuario->getLogin(),
            'senha' => $obUsuario->getSenha(),
            'status_usuario' => $obUsuario->getStatusUsuario(),
        ]);

        return $id_historico;
    }

    public function update(Usuario $obUsuario, int $idUsuario): int
    {
        $this->db->setTable("tb_usuario");

        $arrayUsuario = [
            'nome_usuario' => $obUsuario->getNomeUsuario(),
            'email' => $obUsuario->getEmail(),
            'id_profissao' => $obUsuario->getProfissao()->getIdProfissao(),
            'id_escolaridade' => $obUsuario->getEscolaridade()->getIdEscolaridade(),
            'data_nascimento' => $obUsuario->getDataNascimento(),
            'sexo' => $obUsuario->getSexo(),
            'id_cidade' => null,
            // 'login' => $obUsuario->getLogin(),
            // 'senha' => $obUsuario->getSenha(),
            'status_usuario' => $obUsuario->getStatusUsuario(),
        ];

        $valoresWhere = [
            $idUsuario
        ];

        return $this->db->update2(
            "id_usuario = ?",
            $arrayUsuario,
            $valoresWhere
        );
    }

    public function consulta(): array
    {
        $this->db->setTable("tb_usuario");
        $usuarios = $this->db->selectJoinPersonalizavel(
            null,
            "id_usuario, nome_usuario, email, data_nascimento, sexo, login, status_usuario, id_profissao, id_escolaridade, id_cidade",
            null,
            null,
            [],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        return $usuarios;
    }

    public function consultaParaLogin(string $login)
    {
        $this->db->setTable("tb_usuario");
        $senha = $this->db->selectJoinPersonalizavel(
            null,
            "senha",
            null,
            null,
            [],
            null
        )->fetchColumn();

        if(empty($senha))
        {
            throw new Exception("O usuário, CPF/CNPJ ou senha incorreto!");
        }

        return $senha;
    }
}