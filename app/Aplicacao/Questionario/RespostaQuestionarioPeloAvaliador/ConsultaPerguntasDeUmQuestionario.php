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
        "tb_perguntas.id_pergunta, tb_perguntas.descricao, justificativa, id_resposta", 
        "left join tb_resposta on tb_perguntas.id_pergunta = tb_resposta.id_pergunta",
        null, [$idQuestionario], null)->fetchAll(PDO::FETCH_ASSOC);

        foreach($questionarios as &$questionario)
        {
            if(!empty($questionario['id_pergunta']))
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