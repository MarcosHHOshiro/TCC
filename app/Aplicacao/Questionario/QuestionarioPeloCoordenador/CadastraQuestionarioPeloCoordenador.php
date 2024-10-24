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
  
        $this->verificaSeTemQuestionarioOuCheckListVinculadoAUmaUrl($postVars);
        
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        $obQuestionario = new Questionario;
        $obUsuario = new Usuario;
        $obProfissao = new Profissao;
        $obEscolaridade = new Escolaridade;
        $data = new DateTime();
        $obUrl = new Url();

        $repositorioGeral->setTable('tb_questionario');

        $dados = $repositorioGeral->selectPadrao("tb_questionario.id_questionario = ?", "*",
         "inner join tb_perguntas on tb_questionario.id_questionario = tb_perguntas.id_questionario",
        null, [$postVars['id']])->fetchAll(PDO::FETCH_ASSOC);

        $data = $data->format('Y-m-d');
        $repositrioQuestionario = new RepositorioDeQuestionarioComPdo;
        $idUsuario = $repositrioQuestionario->pegaIdUsuarioLogado($headers);

        $repositrioQuestionario->beginTransaction();
        $obQuestionario->setTitulo($dados[0]['titulo']);
        $obQuestionario->setDescricao($dados[0]['descricao']);
        $obQuestionario->setPadrao('false');
        $obQuestionario->setDataInicio($data);
        $obQuestionario->setTipo($dados[0]['tipo']);
        $obQuestionario->setDataFim(empty($dados[0]['data_fim']) ? null : $dados[0]['data_fim']);
        $obQuestionario->setStatus($dados[0]['status']);
        $obQuestionario->setUsuario($obUsuario->setIdUsuario($idUsuario));
        $obQuestionario->setProfissao($obProfissao->setIdProfissao(empty($dados[0]['id_profissao']) ? null : $dados[0]['id_profissao']));
        $obQuestionario->setUrl($obUrl->setIdUrl($postVars['id_url']));
        $obQuestionario->setEscolaridade($obEscolaridade->setIdEscolaridade(empty($dados[0]['id_escolaridade']) ? null : $postVars['id_escolaridade']));
        
        $idQuestionario = $repositrioQuestionario->cadastrar($obQuestionario);
        $obQuestionario->setIdQuestionario($idQuestionario);
        
        foreach($dados as $dado)
        {
            $obPergunta = new Perguntas;
            $obPergunta->setDescricao($dado['descricao']);
            $obPergunta->setIdPrincipio($dado['id_principio']);
            $obPergunta->setQuestionario($obQuestionario);
            $repositrioQuestionario->cadastrarPerguntas($obPergunta);
        }

        $repositrioQuestionario->commit();

        return["sucesso" => "Cadastro realizado com sucesso!"];  
    }

    private function verificaSeTemQuestionarioOuCheckListVinculadoAUmaUrl($postVars)
    {
        $repositrioQuestionario = new RepositorioDeQuestionarioComPdo;
        $repositrioQuestionario->setTable("tb_questionario");
        $temCadastro = $repositrioQuestionario->selectPadrao('tb_url.id_url = ? and tipo = ?',
        1, 'inner join tb_url on tb_questionario.id_url = tb_url.id_url', null, [$postVars['id_url'], $postVars['tipo_doc']], null)->fetchColumn();
    
        if(!empty($temCadastro))
        {
            throw new Exception("Já tem um questionario/checklist cadastro para essa url");
        }
    }
}