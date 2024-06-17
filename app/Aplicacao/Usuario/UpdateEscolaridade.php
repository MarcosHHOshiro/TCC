<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Escolaridade;
use App\Infra\Usuario\EscolaridadePdo;
use Http\Request;

class updateEscolaridade
{
    public function executa(Request $request, int $idEscolaridade)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars["nome_escolaridade"]))
        {
            throw new \Exception("Informe a escolaridade que deseja alterar!", 400);
        }

        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setNomeEscolaridade(mb_strtoupper($postVars["nome_escolaridade"]));
        $obEscolaridade->setAtiva($postVars["ativa"]);
        $obEscolaridade->setIdEscolaridade($idEscolaridade);

        $useCase = new EscolaridadePdo();
        return $useCase->update($obEscolaridade);
    }
}