<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Dominio\Questionario\Questionario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;

class UpdateQuestionarioPeloCoordenador
{
    public function executa($request, $idQuestionario)
    {
        $header = $request->getHeaders();
        $this->validation($header);
        $repositorio = new RepositorioDeQuestionarioComPdo();
        $postVars = $request->getPostVars();
        $obQuestionario = new Questionario;
        $obQuestionario->setTitulo($postVars['titulo']);
        $obQuestionario->setDescricao($postVars['descricao']);
        $obQuestionario->setDataFim($postVars['data_fim']);
        $obQuestionario->setStatus($postVars['status']);

        $repositorio->updateQuestionario($obQuestionario, $idQuestionario);

        return[
            "sucesso" => "Cadastro atualizado com sucesso!"
        ];
    }

    private function validation($header)
    {
        $repositorio = new RepositorioDeQuestionarioComPdo();

        $idUsuario = $repositorio->pegaIdUsuarioLogado($header);

        $repositorio->setTable('tb_usuario');
        $nivel_acesso = $repositorio->selectPadrao("id_usuario = ? and padrao = false", "permissao", 
        "INNER JOIN tb_questionario on tb_usuario.id_usuario = tb_questionario.id_usuario_criou",
        null, [$idUsuario], null)->fetchColumn();

        if(empty( $nivel_acesso))
        {
            throw new Exception("Você só pode modificar questionários criados por você!");
        }

        if($nivel_acesso == "U")
        {
            throw new Exception("Sem permissão para modificar esse questionario");
        }

        return;
    }
}