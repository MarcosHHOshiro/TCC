<?php

namespace App\Controller;

use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\CadastraQuestionarioPeloAdmin;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\CadastroPerguntaEmQuestionario;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\ConsultaCheckListDoUserLogado;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\ConsultaPerguntasDeCertoQuestionario;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\ConsultaQuestionariosDoUserLogado;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\UpdatePerguntaCadastrada;
use App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin\UpdateQuestionario;
use Http\Request;

class Questionario
{
    public static function cadastroQuestionario(Request $request)
    {
        $useCase = new CadastraQuestionarioPeloAdmin();
        return $useCase->executa($request);
    }

    public static function cadastroPerguntaEmUmQuestionario($request)
    {
        $useCase = new CadastroPerguntaEmQuestionario;
        return $useCase->executa($request);
    }

    public static function updatePergunta($request)
    {
        $useCase = new UpdatePerguntaCadastrada;
        return $useCase->executa($request);
    }

    public static function consultaPerguntaDeCertoQuestionario($request, $idQuestionario)
    {
        $useCase = new ConsultaPerguntasDeCertoQuestionario;
        return $useCase->executa($request, $idQuestionario);
    }

    public static function consultaQuestionariosDoUser($request)
    {
        $useCase = new ConsultaQuestionariosDoUserLogado;
        return $useCase->executa($request);
    }

    public static function consultaChecklistDoUser($request)
    {
        $useCase = new ConsultaCheckListDoUserLogado;
        return $useCase->executa($request);
    }

    public static function updateQuestionario($request, $idQuestionario)
    {
        $useCase = new UpdateQuestionario();
        return $useCase->executa($request, $idQuestionario);
    }
}