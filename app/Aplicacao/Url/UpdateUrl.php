<?php

namespace App\Aplicacao\Url;

use App\Dominio\Url\Url;
use App\Infra\Url\UrlPdo;
use Http\Request;

class UpdateUrl
{
    public function executa(Request $request, int $idUrl) : bool
    {
        $postVars = $request->getPostVars();
        $obUrl = new Url();
        if(empty($postVars['url'])){
            throw new \Exception('Informe o nome da URL para realizar o cadastro!', 400);
        }

        $obUrl->setIdUrl($idUrl);
        $obUrl->setUrl($postVars['url']);
        $obUrl->setDescricao($postVars['descricao']);
        $obUrl->setTipoSite($postVars['tipo_site']);
        $obUrl->setDataInicio($postVars[ 'data_inicio']);
        $obUrl->setDataFim($postVars['data_fim']);

        $useCase = new UrlPdo();
        return $useCase->update($obUrl);
    }
    
}