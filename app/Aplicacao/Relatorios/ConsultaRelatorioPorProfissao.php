<?php

namespace App\Aplicacao\Relatorios;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaRelatorioPorProfissao
{
    public function executa($request, $idRelatorio)
    {

        $repositorioGeral = new RepositorioDeQuestionarioComPdo;

        $dados = $repositorioGeral->selectQueryCompleta("SELECT 
                nome_profissao,
                COUNT( tb_perguntas.id_pergunta) AS total_perguntas_respondidas
            FROM 
                tb_questionario
            INNER JOIN 
                tb_perguntas ON tb_questionario.id_questionario = tb_perguntas.id_questionario
            INNER JOIN 
                tb_resposta ON tb_perguntas.id_pergunta = tb_resposta.id_pergunta
            INNER JOIN 
                tb_usuario ON tb_resposta.id_usuario = tb_usuario.id_usuario
            LEFT JOIN 
                tb_profissao ON tb_usuario.id_profissao = tb_profissao.id_profissao
            WHERE 
                tb_questionario.id_questionario = ? 
                AND tb_resposta.descricao IS NOT NULL
            GROUP BY 
                nome_profissao;",
            [$idRelatorio]
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($dados)) {
            throw new \Exception("Sem cadastro para essa consulta!");
        }

        return $dados;
    }
}