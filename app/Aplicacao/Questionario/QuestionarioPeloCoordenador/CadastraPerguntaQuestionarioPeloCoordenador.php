<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;

class CadastraPerguntaQuestionarioPeloCoordenador
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();
        $repositorio = new RepositorioDeQuestionarioComPdo();
        $obQuestionario = new Questionario;

        $idUsuario = $repositorio->pegaIdUsuarioLogado($headers);   
        $this->verificaSeOUsuarioPodeAdicionarUmaPergunta($postVars['id_questionario'], $idUsuario);

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

    private function verificaSeOUsuarioPodeAdicionarUmaPergunta($idQuestionairo, $idUsuario)
    {
        $repositorio = new RepositorioDeQuestionarioComPdo();

        $id_usuario_criou = $repositorio->selectQueryCompleta("select id_usuario_criou from tb_questionario where id_questionario = ?",
        [$idQuestionairo])->fetchColumn();

        if($id_usuario_criou != $idUsuario)
        {
            throw new Exception("Só é possível editar questionários/checklists criados por você!");
        }

        return;
    }
}