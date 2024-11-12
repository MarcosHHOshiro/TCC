<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;

use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Dominio\Url\Url;
use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use DateTime;

class CadastraQuestionarioPeloAdmin
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();
        $data = new DateTime();
        $data = $data->format('Y-m-d');
        $repositrioQuestionario = new RepositorioDeQuestionarioComPdo;
        $idUsuario = $repositrioQuestionario->pegaIdUsuarioLogado($headers);

        $obQuestionario = new Questionario;
        $obUsuario = new Usuario;
        $obProfissao = new Profissao;
        $obEscolaridade = new Escolaridade;
        $obUrl = new Url;

        $repositrioQuestionario->beginTransaction();
        $obQuestionario->setTitulo($postVars['titulo']);
        $obQuestionario->setDescricao($postVars['descricao']);
        $obQuestionario->setPadrao($postVars['padrao']);
        $obQuestionario->setDataInicio($data);
        $obQuestionario->setTipo($postVars['tipo']);
        $obQuestionario->setDataFim(empty($postVars['data_fim']) ? null : $postVars['data_fim']);
        $obQuestionario->setStatus($postVars['status']);
        $obQuestionario->setUsuario($obUsuario->setIdUsuario($idUsuario));
        $obQuestionario->setProfissao($obProfissao->setIdProfissao(empty($postVars['id_profissao']) ? null : $postVars['id_profissao']));
        $obQuestionario->setEscolaridade($obEscolaridade->setIdEscolaridade(empty($postVars['id_escolaridade']) ? null : $postVars['id_escolaridade']));
        $obQuestionario->setUrl($obUrl);

        $idQuestionario = $repositrioQuestionario->cadastrar($obQuestionario);
        $obQuestionario->setIdQuestionario($idQuestionario);

        if ($postVars['tipo'] == 'Q') {
            $repositrioQuestionario->updatePadrao(
                "padrao = true and id_questionario !=? and tipo = 'Q'",
                [
                    'status' => 'I'
                ],
                [$idQuestionario]
            );
        }

        if ($postVars['tipo'] == 'C') {
            $repositrioQuestionario->updatePadrao(
                "padrao = true and id_questionario !=? and tipo = 'C'",
                [
                    'status' => 'I'
                ],
                [$idQuestionario]
            );
        }

        $obPergunta = new Perguntas;
        $obPergunta->setDescricao($postVars['perguntas'][0]['pergunta']);
        $obPergunta->setJustificativa($postVars['perguntas'][0]['justificativa']);
        // $obPergunta->setIdPrincipio(empty($postVars['perguntas'][0]['principio'])? null : $postVars['perguntas'][0]['principio']);
        $obPergunta->setQuestionario($obQuestionario);
        $repositrioQuestionario->cadastrarPerguntas($obPergunta);

        $repositrioQuestionario->commit();

        return [
            'sucesso' => 'Cadastro realizado com sucesso',
            'id' => $obQuestionario->getIdQuestionario(),
        ];
    }
}