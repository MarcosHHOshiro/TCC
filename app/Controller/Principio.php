<?php

namespace App\Controller;

use App\Aplicacao\Principio\CadastraPrincipio;
use App\Aplicacao\Principio\ConsultaPrincipio;

class Principio
{
    public static function cadastraPrincipio($request)
    {
        $useCase = new CadastraPrincipio;
        return $useCase->executa($request);
    }

    public static function consultaPrincipio($request)
    {
        $useCase = new ConsultaPrincipio;
        return $useCase->executa($request);
    }
}