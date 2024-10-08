<?php
namespace Routes\Api\V1;

use App\Controller\Questionario;
use Http\Response;
// print_r('batata');exit;
$obRouter->post('/api/v1/questionario', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Questionario::cadastroQuestionario($request), 'application/json');
    }
]);

$obRouter->post('/api/v1/questionario/pergunta', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Questionario::cadastroPerguntaEmUmQuestionario($request), 'application/json');
    }
]);

$obRouter->get('/api/v1/questionario/doUsuario', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Questionario::consultaQuestionariosDoUser($request), 'application/json');
    }
]);

$obRouter->get('/api/v1/questionario/checklist/doUsuario', [
    'rolePermissao' => [
        'A', 'C'
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Questionario::consultaChecklistDoUser($request), 'application/json');
    }
]);

$obRouter->get('/api/v1/questionario/perguntas/{idQuestionario}', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idQuestionario)
    {
        return new Response(200, Questionario::consultaPerguntaDeCertoQuestionario($request, $idQuestionario), 'application/json');
    }
]);

$obRouter->patch('/api/v1/questionario/pergunta', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Questionario::updatePergunta($request), 'application/json');
    }
]);

$obRouter->patch('/api/v1/questionario/update/{idQuestionario}', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idQuestionario)
    {
        return new Response(200, Questionario::updateQuestionario($request, $idQuestionario), 'application/json');
    }
]);