<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Escolaridade;
use App\Infra\Usuario\EscolaridadePdo;
use Http\Request;

class CadastroEscolaridade
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['nome_escolaridade']))
        {
            throw new \Exception('Informe o noem da escolaridade para fazer o cadastro', 400);
        }
        
        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setNomeEscolaridade(mb_strtoupper($postVars["nome_escolaridade"]));
        // $obEscolaridade->setAtiva($postVars["ativa"]);

        $banco = new EscolaridadePdo();
        return $banco->cadastro($obEscolaridade);
    }
}