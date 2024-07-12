<?php

namespace App\Aplicacao\Url;

use App\Infra\Url\UrlPdo;
use Http\Request;

class ConsultaUrl
{
    public function executa(Request $request) : array
    {
        $postVars = $request->getPostVars();
        // $obUrl = new Url();

        $useCase = new UrlPdo();
        return $useCase->selectPadrao();
    }
}