<?php

namespace App\Aplicacao\Url;

use App\Dominio\Url\Url;
use App\Infra\Url\UrlPdo;
use Http\Request;

class CadastroUrl
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        $header = $request->getHeaders();
        $obUrl = new Url();
        if(empty($postVars['url'])){
            throw new \Exception('Informe o nome da URL para realizar o cadastro!', 400);
        }

        $useCase = new UrlPdo();
        $idUsuario = $useCase->pegaIdUsuarioLogado($header);

        $obUrl->setUrl($postVars['url']);
        $obUrl->setDescricao($postVars['descricao']);
        $obUrl->setDataInicio($postVars['data_inicio']);
        $obUrl->setDataFim($postVars['data_fim']);
        $obUrl->setTipoSite($postVars['tipo_site']);
        $obUrl->setIdUsuario($idUsuario);

        return $useCase->cadastro($obUrl);
    }
}