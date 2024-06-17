<?php

namespace App\Aplicacao\Usuario;

use app\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\ProfissaoPdo;
use App\Infra\Usuario\UsuarioPdo;
use Http\Request;

class ConsultaProfissao
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();

        $useCase = new ProfissaoPdo();
        return $useCase->consulta();
    }
}