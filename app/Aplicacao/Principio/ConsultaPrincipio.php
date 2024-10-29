<?php

namespace App\Aplicacao\Principio;

use App\Infra\Principio\Geral;
use PDO;

class ConsultaPrincipio
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();

        $repositorioGeral = new Geral();

        $dados = $repositorioGeral->selectQueryCompleta("Select * from tb_principio", [])->fetchAll(PDO::FETCH_ASSOC);
   
        return $dados;
    }
}