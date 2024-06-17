<?php

namespace App\Infra\Usuario;

use App\Dominio\Usuario\Escolaridade;
use Db\DataBase;
use PDO;

class EscolaridadePdo
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function cadastro(Escolaridade $obEscolaridade): int
    {
        $this->db->setTable("tb_escolaridade");
        $id_historico = ($this->db)->insert([
            'nome_escolaridade' => $obEscolaridade->getNomeEscolaridade(),
            'ativa' => 'true'
        ]);

        return $id_historico;
    }
    
    public function consulta(): array
    {
        $this->db->setTable("tb_escolaridade");
        $escolaridade = $this->db->selectJoinPersonalizavel(
            null,
            "*",
            null,
            null,
            [],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        return $escolaridade;
    }

    public function update(Escolaridade $obEscolaridade)
    {
        $this->db->setTable("tb_escolaridade");
        
        $depositoArray = [
            'nome_escolaridade' => $obEscolaridade->getNomeEscolaridade(),
            'ativa' => empty($obEscolaridade->getAtiva()) ? 'false' : $obEscolaridade->getAtiva(),
        ];
        $this->db->update2("id_escolaridade = ?", $depositoArray, [$obEscolaridade->getIdEscolaridade()]);
    }
}