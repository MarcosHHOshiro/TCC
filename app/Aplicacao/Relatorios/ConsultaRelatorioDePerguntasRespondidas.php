<?php

namespace App\Aplicacao\Relatorios;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaRelatorioDePerguntasRespondidas
{
    public function executa($request, $idRelatorio)
    {

        $repositorioGeral = new RepositorioDeQuestionarioComPdo;

        $dados = $repositorioGeral->selectQueryCompleta("SELECT tb_perguntas.id_pergunta, 
        resposta, tb_perguntas.descricao as pergunta, tb_resposta.descricao
            from tb_questionario
            inner join tb_perguntas on tb_questionario.id_questionario = tb_perguntas.id_questionario
            inner join tb_resposta on tb_perguntas.id_pergunta = tb_resposta.id_pergunta
            where tb_questionario.id_questionario = ? AND tb_resposta.descricao is not null",
            [$idRelatorio]
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($dados)) {
            throw new \Exception("Sem cadastro para essa consulta!");
        }

        return $dados;
    }
}