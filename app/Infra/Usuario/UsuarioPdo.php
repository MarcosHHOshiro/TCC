<?php

namespace App\Infra\Usuario;

use app\Dominio\Usuario\Usuario;
use Db\DataBase;
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
            'id_profissao' => $obUsuario->getIdProfissao(),
            'id_escolaridade' => $obUsuario->getIdEscolaridade(),
            'data_nascimento' => $obUsuario->getDataNascimento(),
            'sexo' => $obUsuario->getSexo(),
            'id_cidade' => $obUsuario->getIdCidade(),
            'login' => $obUsuario->getLogin(),
            'senha' => $obUsuario->getSenha(),
            'status_usuario' => $obUsuario->getStatusUsuario(),
        ]);

        return $id_historico;
    }
    
    public function consulta(): array
    {
        $this->db->setTable("tb_usuario");
        $usuarios = $this->db->selectJoinPersonalizavel(
            null,
            "*",
            null,
            null,
            [],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        return $usuarios;
    }
}