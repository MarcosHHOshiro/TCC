<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class CadastraRespostaQuestionario
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();

        if(empty($postVars['data_inicio']))
        {
            throw new \Exception("Informe a data de inicio!");
        }
        if(empty($postVars['data_fim']))
        {
            throw new \Exception("Informe a data de fim!");
        }
        
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);
        
        $repositorioGeral->setTable('tb_resposta');
        $repositorioGeral->inserPadrao([
            "id_usuario" => $idUsuario,
            "id_pergunta" => $postVars['id_pergunta'],
            "resposta" => $postVars['resposta'],
            "descricao" => $postVars['descricao'],
        ]);

        return[
            "sucesso" => "Pergunta respondida!"
        ];
    }
}