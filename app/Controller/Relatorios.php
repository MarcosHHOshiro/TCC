<?php

namespace App\Controller;

use App\Aplicacao\Relatorios\ConsultaResultadosQUestionariosPelasPerguntas;

class Relatorios
{
    public static function consultaResultadosQuestionariosPelasPerguntas($request, $idRelatorio)
    {
        $useCase = new ConsultaResultadosQUestionariosPelasPerguntas();
        return $useCase->executa($request, $idRelatorio);
    }
}