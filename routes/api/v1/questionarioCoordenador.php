<?php

namespace Routes\Api\V1;

use App\Controller\Questionario;
use App\Controller\QuestionarioCoordenador;
use Http\Response;
// print_r('batata');exit;
$obRouter->post('/api/v1/questionarioCoordenador', [
    'rolePermissao' => [
        'A',
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
