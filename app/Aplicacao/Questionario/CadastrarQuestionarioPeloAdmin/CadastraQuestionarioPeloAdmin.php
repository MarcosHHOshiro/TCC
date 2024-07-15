<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;

class CadastrarQuestionarioPeloAdmin
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        $obUrl = new Url();
        if(empty($postVars['url'])){
            throw new \Exception('Informe o nome da URL para realizar o cadastro!', 400);
        }

        $obUrl->setUrl($postVars['url']);
        $obUrl->setDescricao($postVars['descricao']);
        $obUrl->setTipoSite($postVars['tipo_site']);

        $useCase = new UrlPdo();
        return $useCase->cadastro($obUrl);
    }
}