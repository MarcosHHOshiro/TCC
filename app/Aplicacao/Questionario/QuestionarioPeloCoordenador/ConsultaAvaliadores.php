<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaAvaliadores
{
    public function     executa($request, $idUrl)
    {
        $postVars = $request->getPostVars();
        $queryParams = $request->getQueryParams();

        $stringWhere = '';
        $valores = [];

        if (!empty($queryParams['id_profissao'])) {
            $stringWhere .= " id_profissao = ? AND";
            array_push($valores, "{$queryParams['id_profissao']}");
        }

        $stringWhere = $stringWhere . " permissao = 'U' and";
        array_push($valores, "{$idUrl}");

        $last_space = strrpos($stringWhere, " ");
        $stringWhere = substr($stringWhere, 0, $last_space);

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable("tb_usuario");
        $usuarios = $repositorioGeral->selectQueryCompleta("SELECT tb_usuario.id_usuario,
        nome_usuario, permissao, cidade, estado
            FROM tb_usuario 
            WHERE $stringWhere
              AND tb_usuario.id_usuario NOT IN (
                  SELECT id_usuario 
                  FROM rl_acesso_questionario 
                  WHERE id_url = ?
            );", $valores)->fetchAll(PDO::FETCH_ASSOC);

        if (empty($usuarios)) {
            throw new \Exception("Sem cadastro para essa consulta");
        }

        return $usuarios;
    }
}