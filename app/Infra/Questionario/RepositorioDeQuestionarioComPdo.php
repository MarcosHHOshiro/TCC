<?php

namespace App\Infra\Questionario;

use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Dominio\Url\Url;
use DB\DataBase;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RepositorioDeQuestionarioComPdo
{

    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->db->commit();
    }

    public function setTable($table)
    {
        $this->db->setTable($table);
    }

    public function cadastrar(Questionario $questionario): int
    {
        $this->db->setTable("tb_questionario");
        $idUrl = ($this->db)->insert([
            'titulo' => $questionario->getTitulo(),
            'descricao' => $questionario->getDescricao(),
            'id_usuario_criou' => $questionario->getUsuario()->getIdUsuario(),
            'padrao' => $questionario->getPadrao(),
            'data_inicio' => $questionario->getDataInicio(),
            'data_fim' => $questionario->getDataFim(),
            'status' => $questionario->getStatus(),
            'tipo' => $questionario->getTipo(),
            'id_profissao' => $questionario->getProfissao()->getIdProfissao(),
            'id_url' => $questionario->getUrl()->getIdUrl(),
            'id_escolaridade' => $questionario->getEscolaridade()->getIdEscolaridade()
        ]);

        return $idUrl;
    }

    public function cadastrarPerguntas(Perguntas $perguntas): int
    {
        $this->db->setTable("tb_perguntas");
        $id = ($this->db)->insert([
            'descricao' => $perguntas->getDescricao(),
            'id_principio' => $perguntas->getIdPrincipio(),
            'justificativa' => $perguntas->getJustificativa(),
            'id_questionario' => $perguntas->getQuestionario()->getIdQuestionario()
        ]);

        return $id;
    }

    public function pegaIdUsuarioLogado($header)
    {
        $jwt = isset($header['Authorization']) ? str_replace('Bearer ', '', $header['Authorization']) : '';

        try {
            //decode
            $decode = (array) JWT::decode($jwt, new Key(getenv('JWT_KEY'), 'HS256'));
        } catch (\Exception $e) {
            throw new \Exception("Token invalido", 403);
        }
        $login = $decode['login'] ?? '';

        $this->db->setTable("tb_usuario");
        $id = $this->db->selectJoinPersonalizavel("login = ?", "id_usuario", null, null, [$login], null)->fetchColumn();

        return $id;
    }

    public function updatePerguntas(Perguntas $obPergunta, int $idPergunta)
    {
        $this->db->setTable("tb_perguntas");
        $this->db->update2("id_pergunta = ?", [
            'descricao' => $obPergunta->getDescricao(),
            'id_principio' => $obPergunta->getIdPrincipio(),
            'justificativa' => $obPergunta->getJustificativa(),
        ], [$idPergunta]);
    }

    public function updateQuestionario(Questionario $obQuestionario, int $idQuestionario)
    {
        $this->db->setTable("tb_questionario");
        $this->db->update2("id_questionario = ?", [
            'titulo' => $obQuestionario->getTitulo(),
            'descricao' => $obQuestionario->getDescricao(),
            'data_fim' => $obQuestionario->getDataFim(),
            'status' => $obQuestionario->getStatus()
        ], [$idQuestionario]);

        return;
    }

    public function selectPadrao(string $where = null, string $fields = '*', string $join = null, string $groupBy = null, array $values = null, string $orderBy = null)
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

    public function insertPadraoSemId(array $array)
    {
        return $this->db->insertSemId($array);
    }

    public function insertPadrao(array $array)
    {
        return $this->db->insert($array);
    }

    public function selectQueryCompleta(string $query, array $values)
    {
        return $this->db->selectQueryCompleta($query, $values);
    }

}