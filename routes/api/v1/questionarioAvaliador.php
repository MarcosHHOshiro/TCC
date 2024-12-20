<?php

namespace Routes\Api\V1;

use App\Controller\QuestionarioAvaliador;
use App\Controller\QuestionarioCoordenador;
use Http\Response;
// print_r('batata');exit;
$obRouter->get('/api/v1/questionarioAvaliador/urlQueOUsuarioTemAcesso', [
    'rolePermissao' => [
        'U',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request) {
        return new Response(200, QuestionarioAvaliador::consultaUrlQueOAvaliadorTemAcesso($request), 'application/json');
    }
]);

$obRouter->post('/api/v1/questionarioAvaliador/respondePergunta', [
    'rolePermissao' => [
        'U',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request) {
        return new Response(200, QuestionarioAvaliador::respondePerguntaQuestionario($request), 'application/json');
    }
]);

$obRouter->get('/api/v1/questionarioAvaliador/veTodasPerguntasRespondidas/{idQuestionario}', [
    'rolePermissao' => [
        'U',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idQuestionario) {
        return new Response(200, QuestionarioAvaliador::consultaTodasAsPerguntasAposResponder($request, $idQuestionario), 'application/json');
    }
]);

$obRouter->patch('/api/v1/questionarioAvaliador/updateResposta/{idPergunta}', [
    'rolePermissao' => [
        'U',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idPergunta) {
        return new Response(200, QuestionarioAvaliador::updateResposta($request, $idPergunta), 'application/json');
    }
]);

$obRouter->get('/api/v1/questionarioAvaliador/{idQuestionario}', [
    'rolePermissao' => [
        'U',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idQuestionario) {
        return new Response(200, QuestionarioAvaliador::consultaPerguntasDeUmQuestionario($request, $idQuestionario), 'application/json');
    }
]);

