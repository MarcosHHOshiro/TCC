<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Http\Request;

class ConsultaUsuario
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();

        $useCase = new UsuarioPdo();
        return $useCase->consulta($request);
    }
}