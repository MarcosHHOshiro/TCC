<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Profissao;
use App\Infra\Usuario\ProfissaoPdo;
use Http\Request;

class UpdateProfissao
{
    public function executa(Request $request, int $idProfissao)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars["nome_profissao"]))
        {
            throw new \Exception("Informe o nome da profissao que deseja alterar!", 400);
        }

        $obProfissao = new Profissao();
        $obProfissao->setNomeProfissao(mb_strtoupper($postVars["nome_profissao"]));
        $obProfissao->setAtiva($postVars["ativa"]);
        $obProfissao->setIdProfissao($idProfissao);

        $useCase = new ProfissaoPdo();
        return $useCase->update($obProfissao);
    }
}