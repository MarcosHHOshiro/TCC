<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;
use PDO;

class ConsultaPerguntasDeUmQuestionario
{
    public function executa($request, $idQuestionario)
    {
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        // $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);

        $repositorioGeral->setTable("tb_perguntas");
        $questionarios = $repositorioGeral->selectPadrao("tb_perguntas.id_questionario = ?",
        "id_pergunta, descricao, justificativa", 
        null,
        null, [$idQuestionario], null)->fetchAll(PDO::FETCH_ASSOC);

        if(empty($questionarios))
        {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $questionarios;
    }
}