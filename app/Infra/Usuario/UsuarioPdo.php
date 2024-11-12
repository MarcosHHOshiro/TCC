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

    public function setTable(string $table)
    {
        $this->db->setTable($table);
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
            'permitido' => $obUsuario->getPermitido(),
            'permissao' => $obUsuario->getPermissao(),
            'status_usuario' => $obUsuario->getStatusUsuario(),
            'estado' => $obUsuario->getEstado(),
            'cidade' => $obUsuario->getCidade(),
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
            "id_usuario, nome_usuario, email, data_nascimento, sexo, login, status_usuario, id_profissao, id_escolaridade, id_cidade, permissao",
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
        $dados = $this->db->selectJoinPersonalizavel(
            "login = ?",
            "senha, permissao, nome_usuario",
            null,
            null,
            [$login],
            null
        )->fetch(PDO::FETCH_ASSOC);
        
        if(empty($dados))
        {
            throw new Exception("O usuário, CPF/CNPJ ou senha incorreto!");
        }

        return $dados;
    }

    public function selectPadrao(string $where = null,string $fields = '*', string $join = null, string $groupBy = null, array $values = null, string $orderBy = null)
    {
        $query = $this->db->selectJoinPersonalizavel(
            $where, 
            $fields, 
            $join, 
            $groupBy, 
            $values,
            $orderBy
        );

        return $query;
    }

    public function updatePadrao(string $where, array $values, array $valoresWhere)
    {
        $query = $this->db->update2($where, $values, $valoresWhere);

        return $query;
    }
}