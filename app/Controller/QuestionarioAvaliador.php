<?php

namespace App\Controller;

use App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador\CadastraRespostaQuestionario;
use App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador\ConsultaPerguntasDeUmQuestionario;
use App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador\ConsultaUrlQueOUsuarioTemAcesso;

class QuestionarioAvaliador
{
    public static function consultaPerguntasDeUmQuestionario($request, $idQuestionario)
    {
        $useCase = new ConsultaPerguntasDeUmQuestionario();
        return $useCase->executa($request, $idQuestionario);
    }

    public static function consultaUrlQueOAvaliadorTemAcesso($request)
    {
        $useCase = new ConsultaUrlQueOUsuarioTemAcesso();
        return $useCase->executa($request);
    }
    

    public static function respondePerguntaQuestionario($request)
    {
        $useCase = new CadastraRespostaQuestionario();
        return $useCase->executa($request);
    }
}