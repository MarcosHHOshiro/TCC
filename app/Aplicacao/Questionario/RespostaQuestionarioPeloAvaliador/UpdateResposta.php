<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class UpdateResposta
{
    public function executa($request, $idPergunta)
    {
        $postvars = $request->getPostVars();
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable('tb_resposta');
        $repositorioGeral->updatePadrao('id_pergunta = ?', 
        [
            'resposta' => $postvars['resposta']
        ], [$idPergunta]);

        return
        [
            "sucesso" => "Resposta cadastra com sucesso !"
        ];
    }
}