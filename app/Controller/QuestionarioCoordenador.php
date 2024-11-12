<?php

namespace App\Controller;

use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\AvaliadoresVinculadosAUmQustionario;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastraPerguntaQuestionarioPeloCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastraQuestionarioPeloCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\CadastroAcessoQuestionario;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\ConsultaAvaliadores;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\ConsultaChecklistDoCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\ConsultaPerguntasQuestionario;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\ConsultaQuestionariosDoCoordenador;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\UpdatePergunta;
use App\Aplicacao\Questionario\QuestionarioPeloCoordenador\UpdateQuestionarioPeloCoordenador;
use App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador\ConsultaPerguntasDeUmQuestionario;
use Http\Request;

class QuestionarioCoordenador
{

    public static function cadastroQuestionarioPeloCoordenador(Request $request)
    {
        $useCase = new CadastraQuestionarioPeloCoordenador();
        return $useCase->executa($request);
    }

    public static function cadastroPerguntaQuestionarioPeloCoordenador($request)
    {
        $useCase = new CadastraPerguntaQuestionarioPeloCoordenador();
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

    public static function consulktaAvaliadores($request, $idUrl)
    {
        $useCase = new ConsultaAvaliadores();
        return $useCase->executa($request, $idUrl);
    }

    public static function vinculaUsuarioComQustionario($request)
    {
        $useCase = new CadastroAcessoQuestionario();
        return $useCase->executa($request);
    }

    public static function consultaQuaisAvaliadoresTemAcessoAoQuestionairo($request, $idUrl)
    {
        $useCase = new AvaliadoresVinculadosAUmQustionario();
        return $useCase->executa($request, $idUrl);
    }

    public static function consultaQuestionarioDoCoordenador($request)
    {
        $useCase = new ConsultaQuestionariosDoCoordenador;
        return $useCase->executa($request);
    }

    public static function consultaCheckListDoCoordenador($request)
    {
        $useCase = new ConsultaChecklistDoCoordenador;
        return $useCase->executa($request);
    }

    public static function consultaPerguntasDeUmQuestionario($request, $idQuestionario)
    {
        $useCase = new ConsultaPerguntasQuestionario;
        return $useCase->executa($request, $idQuestionario);
    }
}