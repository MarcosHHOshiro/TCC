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
        $headers = $request->getHeaders();
        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);

        $repositorioGeral->setTable("tb_perguntas");
        $questionarios = $repositorioGeral->selectPadrao("tb_perguntas.id_questionario = ?",
        "tb_perguntas.id_pergunta, tb_perguntas.descricao, justificativa", 
        null,
        null, [$idQuestionario], null)->fetchAll(PDO::FETCH_ASSOC);

        if(empty($questionarios))
        {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        foreach($questionarios as &$questionario)
        {
            $repositorioGeral->setTable("tb_resposta");
            $usuarioRespondeu = $repositorioGeral->selectPadrao("tb_resposta.id_pergunta = ? and tb_resposta.id_usuario = ?",
            "*", 
            null,
            null, [$questionario['id_pergunta'], $idUsuario], null)->fetchColumn();

            if(empty($usuarioRespondeu))
            {
                $questionario['respondido'] = 0; 
            }else{
                $questionario['respondido'] = 1; 
            }
        }

        if(empty($questionarios))
        {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $questionarios;
    }
}