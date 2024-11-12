<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;

use App\Dominio\Questionario\Questionario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class UpdateQuestionario
{
    public function executa($request, $idQuestionario)
    {
        $postVars = $request->getPostVars();
        $obQuestionario = new Questionario;
        $obQuestionario->setTitulo($postVars['titulo']);
        $obQuestionario->setDescricao($postVars['descricao']);
        $obQuestionario->setDataFim($postVars['data_fim']);
        $obQuestionario->setStatus($postVars['status']);
        $obQuestionario->setPadrao($postVars['padrao']);

        $repositorio = new RepositorioDeQuestionarioComPdo();
        $repositorio->updateQuestionario($obQuestionario, $idQuestionario);

        return[
            "sucesso" => "Cadastro atualizado com sucesso!"
        ];
    }
}