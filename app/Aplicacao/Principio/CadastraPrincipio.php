<?php

namespace App\Aplicacao\Principio;

use App\Infra\Principio\Geral;

class CadastraPrincipio
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $repositorioGeral = new Geral();

        $repositorioGeral->setTable("tb_principio");
        $repositorioGeral->insertPadrao(
            [
                'descricao'=>$postVars['descricao']
            ]
        );

        return [
            'sucesso' => 'Cadastro realizado com sucesso!'
        ];
    }
}