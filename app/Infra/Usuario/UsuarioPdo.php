<?php

namespace App\Infra\Usuario;

use app\Dominio\Usuario\Usuario;
use Db\DataBase;

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
            'email' => empty($postVars['data_lanc']) ? $dataAtual : $postVars['data_lanc'],
            'id_profissao' => $postVars['observacoes'],
            'id_escolaridade' => $postVars['data_emissao'],
            'data_nascimento' => $postVars['documento'],
            'sexo' => $postVars['id_historico'],
            'id_cidade' => $valor,
            'login' => 'P',
            'senha' => $postVars['id_tipo_receita'],
            'status_usuario' => $postVars['id_empresa'],
        ]);

        return $id_historico;
    }
    
}