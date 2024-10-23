<?php

namespace App\Controller;

use App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador\ConsultaQuestionariosQueOUsuarioTemAcesso;

class QuestionarioAvaliador
{
    public static function consultaPerguntasDeUmQuestionario($request)
    {
        $useCase = new ConsultaQuestionariosQueOUsuarioTemAcesso();
        return $useCase->executa($request);
    }

    
}