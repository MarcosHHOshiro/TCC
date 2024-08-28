<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;
use App\Dominio\Questionario\Perguntas;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class UpdatePerguntaCadastrada
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $obPergunta = new Perguntas;
        $obPergunta->setDescricao($postVars['pergunta']);
        $obPergunta->setIdPrincipio($postVars['principio']);
        $obPergunta->setJustificativa($postVars['justificativa']);

        $repositorio = new RepositorioDeQuestionarioComPdo();
        $repositorio->updatePerguntas($obPergunta, $postVars['id_pergunta']);

        return[
            "sucesso" => "Cadastro atualizado com sucesso!"
        ];
    }
}