<?php

namespace Routes\Api\V1;

use App\Controller\QuestionarioAvaliador;
use App\Controller\QuestionarioCoordenador;
use Http\Response;
// print_r('batata');exit;
$obRouter->get('/api/v1/questionarioAvaliador', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request) {
        return new Response(200, QuestionarioAvaliador::consultaPerguntasDeUmQuestionario($request), 'application/json');
    }
]);

