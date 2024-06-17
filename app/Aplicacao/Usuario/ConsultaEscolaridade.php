<?php

namespace App\Aplicacao\Usuario;

use App\Infra\Usuario\EscolaridadePdo;
use Http\Request;

class ConsultaEscolaridade
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();

        $useCase = new EscolaridadePdo();
        return $useCase->consulta();
    }
}