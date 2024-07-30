<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;
use app\Dominio\Questionario\Questionario;
use app\Dominio\Url\Url;
use app\Dominio\Usuario\Escolaridade;
use app\Dominio\Usuario\Profissao;
use app\Dominio\Usuario\Usuario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;

class CadastrarQuestionarioPeloAdmin
{
    
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();

        if(empty($postVars['url'])){
            throw new \Exception('Informe o nome da URL para realizar o cadastro!', 400);
        }

        $idUsuario = $this->pegaIdUsuario();

        $obUrl = new Url();
        $obUrl->setIdUrl($postVars['id_url']);

        $obUsuario = new Usuario();
        $obUsuario->setIdUsuario($idUsuario);

        $obProfissao = new Profissao();
        $obProfissao->setIdProfissao($postVars['id_profissao']);

        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setIdEscolaridade($postVars['id_escolaridade']);

        $obQuestionario = new Questionario();
        $obQuestionario->setUrl($obUrl);
        $obQuestionario->setDescricao($postVars['descricao']);
        $obQuestionario->setTitulo($postVars['titulo']);
        $obQuestionario->setUsuario($obUsuario);
        $obQuestionario->setPadrao($postVars['padrao']);
        $obQuestionario->setDataInicio($postVars['data_inicio']);
        $obQuestionario->setDataFim($postVars['data_fim']);
        $obQuestionario->setStatus($postVars['status']);
        $obQuestionario->setProfissao($obProfissao);
        $obQuestionario->setEscolaridade($obEscolaridade);
 
        $useCase = new RepositorioDeQuestionarioComPdo();
        return $useCase->cadastrar($obQuestionario);
    }

    private function pegaIdUsuario()
    {
        return 1;
    }
}