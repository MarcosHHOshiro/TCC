<?php
namespace Routes\Api\V1;

use App\Controller\Relatorios;
use Http\Response;
// print_r('batata');exit;
$obRouter->get('/api/v1/relatorios/porPerguntas/{idRelatorio}', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idRelatorio)
    {
        return new Response(200, Relatorios::consultaResultadosQuestionariosPelasPerguntas($request, $idRelatorio), 'application/json');
    }
]);

$obRouter->get('/api/v1/relatorios/perguntasRespondidas/{idRelatorio}', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idRelatorio)
    {
        return new Response(200, Relatorios::consultaPerguntasComResposta($request, $idRelatorio), 'application/json');
    }
]);

$obRouter->get('/api/v1/relatorios/porProfissao/{idRelatorio}', [
    'rolePermissao' => [
        'A',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idRelatorio)
    {
        return new Response(200, Relatorios::consultaPorProfissao($request, $idRelatorio), 'application/json');
    }
]);