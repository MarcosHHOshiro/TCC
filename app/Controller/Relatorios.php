<?php

namespace App\Controller;

use App\Aplicacao\Relatorios\ConsultaRelatorioDePerguntasRespondidas;
use App\Aplicacao\Relatorios\ConsultaRelatorioPorProfissao;
use App\Aplicacao\Relatorios\ConsultaResultadosQUestionariosPelasPerguntas;

class Relatorios
{
    public static function consultaResultadosQuestionariosPelasPerguntas($request, $idRelatorio)
    {
        $useCase = new ConsultaResultadosQUestionariosPelasPerguntas();
        return $useCase->executa($request, $idRelatorio);
    }

    public static function consultaPerguntasComResposta($request, $idRelatorio)
    {
        $useCase = new ConsultaRelatorioDePerguntasRespondidas();
        return $useCase->executa($request, $idRelatorio);
    }

    public static function consultaPorProfissao($request, $idRelatorio)
    {
        $useCase = new ConsultaRelatorioPorProfissao();
        return $useCase->executa($request, $idRelatorio);
    }
}