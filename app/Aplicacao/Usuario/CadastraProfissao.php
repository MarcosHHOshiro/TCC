<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Profissao;
use App\Infra\Usuario\ProfissaoPdo;
use Http\Request;

class CadastraProfissao
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        $obProfissao = new Profissao();
        if(empty($postVars['nome_profissao'])){
            throw new \Exception('Informe o nome da profissão para realizar o cadastro!', 400);
        }

        $obProfissao->setNomeProfissao(mb_strtoupper($postVars["nome_profissao"]));
        $obProfissao->setAtiva('true');

        $useCase = new ProfissaoPdo();
        return $useCase->cadastro($obProfissao);
    }
}