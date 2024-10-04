<?php

namespace App\Controller;

use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastraQuestionarioPeloCoordenador;
use Http\Request;

class QuestionarioCoordenador
{
    
    public static function cadastroQuestionarioPeloCoordenador(Request $request)
    {
        $useCase = new CadastraQuestionarioPeloCoordenador();
        return $useCase->executa($request);
    }

}