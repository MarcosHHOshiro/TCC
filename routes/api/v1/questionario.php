<?php
namespace Routes\api\v1;

// use App\Controller\Url;
use Http\Response;

$obRouter->post('/api/v1/questionario', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Url::cadastroUrl($request), 'application/json');
    }
]);

