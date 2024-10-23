<?php

namespace App\Controller;

use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\AvaliadoresVinculadosAUmQustionario;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastraQuestionarioPeloCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastroAcessoQuestionario;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\ConsultaAvaliadores;
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

    public static function consulktaAvaliadores($request)
    {
        $useCase = new ConsultaAvaliadores();
        return $useCase->executa($request);
    }

    public static function vinculaUsuarioComQustionario($request)
    {
        $useCase = new CadastroAcessoQuestionario();
        return $useCase->executa($request);
    }

    public static function consultaQuaisAvaliadoresTemAcessoAoQuestionairo($request, $idQuestionario)
    {
        $useCase = new AvaliadoresVinculadosAUmQustionario();
        return $useCase->executa($request, $idQuestionario);
    }
}