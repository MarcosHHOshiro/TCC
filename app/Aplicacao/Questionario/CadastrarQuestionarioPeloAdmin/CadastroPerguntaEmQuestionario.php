<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;
use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class CadastroPerguntaEmQuestionario
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $repositorio = new RepositorioDeQuestionarioComPdo();
        $obQuestionario = new Questionario;

        $obPergunta = new Perguntas;
        $obPergunta->setDescricao($postVars['pergunta']);
        $obPergunta->setJustificativa($postVars['justificativa']);
        $obPergunta->setQuestionario($obQuestionario->setIdQuestionario($postVars['id_questionario']));
        // $obPergunta->setIdPrincipio(empty($postVars[''])? null :$postVars['']);

        $repositorio->cadastrarPerguntas($obPergunta);

        return [
            "sucesso" => "Cadastro realizado com sucesso!"
        ];
    }
}