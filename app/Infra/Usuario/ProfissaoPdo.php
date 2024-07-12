<?php

namespace App\Infra\Usuario;

use app\Dominio\Usuario\Profissao;
use app\Dominio\Usuario\Usuario;
use Db\DataBase;
use PDO;

class ProfissaoPdo
{
    private DataBase $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function cadastro(Profissao $obProfissao): int
    {
        $this->db->setTable("tb_profissao");
        $id_historico = ($this->db)->insert([
            'nome_profissao' => $obProfissao->getNomeProfissao(),
            'ativa' => $obProfissao->getAtiva(),
        ]);

        return $id_historico;
    }
    
    public function consulta(): array
    {
        $this->db->setTable("tb_profissao");
        $profissoes = $this->db->selectJoinPersonalizavel(
            null,
            "*",
            null,
            null,
            [],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        return $profissoes;
    }

    public function update(Profissao $obProfissao)
    {
        $this->db->setTable("tb_profissao");
        
        $depositoArray = [
            'nome_profissao' => $obProfissao->getNomeProfissao(),
            'ativa' => empty($obProfissao->getAtiva()) ? 'false' : $obProfissao->getAtiva(),
        ];
        $this->db->update2("id_profissao = ?", $depositoArray, [$obProfissao->getIdProfissao()]);
    }

    public function consultaProfissaoEUsuario(int $idProfissao): array
    {
        $this->db->setTable("tb_profissao");
        $profissoesUsuario = $this->db->selectJoinPersonalizavel(
            'tb_profissao.id_profissao = ?',
            "id_usuario",
            "INNER JOIN tb_usuario ON tb_profissao.id_profissao = tb_usuario.id_profissao",
            null,
            [$idProfissao],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        return $profissoesUsuario;
    }

    public function deleta(int $idProfissao)
    {
        $this->db->setTable("tb_profissao");
        
        return $this->db->delete("id_profissao = ?", [$idProfissao]);
    }
}