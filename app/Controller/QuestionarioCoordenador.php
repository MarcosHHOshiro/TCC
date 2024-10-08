<?php

namespace App\Controller;

use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastraQuestionarioPeloCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\UpdatePergunta;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\UpdateQuestionarioPeloCoordenador;
use Http\Request;

class QuestionarioCoordenador
{
    
    public static function cadastroQuestionarioPeloCoordenador(Request $request)
    {
        $useCase = new CadastraQuestionarioPeloCoordenador();
        return $useCase->executa($request);
    }

    public static function updateQuestionarioPeloCoordenador($request, $idQuestionario)
    {
        $useCase = new UpdateQuestionarioPeloCoordenador();
        return $useCase->executa($request, $idQuestionario);
    }

    public static function updatePergunta($request)
    {
        $useCase = new UpdatePergunta();
        return $useCase->executa($request);
    }
}