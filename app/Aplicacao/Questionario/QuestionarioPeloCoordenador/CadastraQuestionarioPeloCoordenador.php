<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Dominio\Questionario\Perguntas;
use App\Dominio\Questionario\Questionario;
use App\Dominio\Url\Url;
use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use DateTime;
use Exception;
use PDO;

class CadastraQuestionarioPeloCoordenador
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        $obQuestionario = new Questionario;
        $obUsuario = new Usuario;
        $obProfissao = new Profissao;
        $obEscolaridade = new Escolaridade;
        $obUrl = new Url();

        $repositorioGeral->setTable('tb_questionario');
        $dados = $repositorioGeral->selectPadrao(
            "tb_questionario.padrao = true and status = 'A' ",
            "tb_questionario.*, 
            json_agg(json_build_object(
                'descricao', tb_perguntas.descricao,
                'justificativa', justificativa
            )) as perguntas",
            "inner join tb_perguntas on tb_questionario.id_questionario = tb_perguntas.id_questionario
            LEFT JOIN tb_url ON tb_questionario.id_url = tb_url.id_url",
            "tb_questionario.id_questionario",
            []
        )->fetchAll(PDO::FETCH_ASSOC);

        if(!isset($dados[0]) and !isset($dados[1]))
        {
            throw new Exception("Ative pelo um checklist/questionário padrão!");
        }

        $repositrioQuestionario = new RepositorioDeQuestionarioComPdo;
        $repositrioQuestionario->beginTransaction();

        foreach ($dados as &$dado) {
            $jaCadastrou = $this->verificaSeTemQuestionarioOuCheckListVinculadoAUmaUrl($postVars, $dado);
            
            $dado['perguntas'] = json_decode($dado['perguntas'], true);

            if ($jaCadastrou == 0) {
                $data = new DateTime();
                $data = $data->format('Y-m-d');
                $idUsuario = $repositrioQuestionario->pegaIdUsuarioLogado($headers);

                $obQuestionario->setTitulo($dado['titulo']);
                $obQuestionario->setDescricao($dado['descricao']);
                $obQuestionario->setPadrao(0);
                $obQuestionario->setDataInicio($data);
                $obQuestionario->setTipo($dado['tipo']);
                $obQuestionario->setDataFim(empty($dado['data_fim']) ? null : $dado['data_fim']);
                $obQuestionario->setStatus($dado['status']);
                $obQuestionario->setUsuario($obUsuario->setIdUsuario($idUsuario));
                $obQuestionario->setProfissao($obProfissao->setIdProfissao(empty($dado['id_profissao']) ? null : $dado['id_profissao']));
                $obQuestionario->setUrl($obUrl->setIdUrl($postVars['id_url']));
                $obQuestionario->setEscolaridade($obEscolaridade->setIdEscolaridade(empty($dado['id_escolaridade']) ? null : $postVars['id_escolaridade']));

                $idQuestionario = $repositrioQuestionario->cadastrar($obQuestionario);
                $obQuestionario->setIdQuestionario($idQuestionario);

                foreach ($dado['perguntas'] as $pergunta) {

                    $obPergunta = new Perguntas;
                    $obPergunta->setDescricao($pergunta['descricao']);
                    // $obPergunta->setIdPrincipio($pergunta['id_principio']);
                    $obPergunta->setJustificativa($pergunta['justificativa']);
                    $obPergunta->setQuestionario($obQuestionario);
                    $repositrioQuestionario->cadastrarPerguntas($obPergunta);
                }
            }

        }
        $repositrioQuestionario->commit();

        return ["sucesso" => "Cadastro realizado com sucesso!"];
    }

    private function verificaSeTemQuestionarioOuCheckListVinculadoAUmaUrl($postVars, $dado)
    {
        $repositrioQuestionario = new RepositorioDeQuestionarioComPdo;
        $repositrioQuestionario->setTable("tb_questionario");
        $temCadastro = $repositrioQuestionario->selectPadrao(
            'tb_url.id_url = ? and tipo = ?',
            1,
            'inner join tb_url on tb_questionario.id_url = tb_url.id_url',
            null,
            [$postVars['id_url'], $dado['tipo']],
            null
        )->fetchColumn();

        if (!empty($temCadastro)) {
            $temCadastro = 1;
        } else {
            $temCadastro = 0;
        }

        return $temCadastro;
    }
}