<?php

namespace Routes\Api\V1;

use App\Controller\Questionario;
use App\Controller\QuestionarioCoordenador;
use Http\Response;
// print_r('batata');exit;
$obRouter->post('/api/v1/questionarioCoordenador', [
    'rolePermissao' => [
        'C',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, QuestionarioCoordenador::cadastroQuestionarioPeloCoordenador($request), 'application/json');
    }
]);

$obRouter->patch('/api/v1/questionarioCoordenador/update/{idQuestionario}', [
    'rolePermissao' => [
        'C','A'
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idQuestionario)
    {
        return new Response(200, QuestionarioCoordenador::updateQuestionarioPeloCoordenador($request, $idQuestionario), 'application/json');
    }
]);

$obRouter->patch('/api/v1/questionarioCoordenador/pergunta/update', [
    'rolePermissao' => [
        'C','A'
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, QuestionarioCoordenador::updatePergunta($request), 'application/json');
    }
]);