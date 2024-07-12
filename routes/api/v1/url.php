<?php
namespace Routes\api\v1;

use App\Controller\Url;
use Http\Response;

$obRouter->post('/api/v1/url', [
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

$obRouter->get('/api/v1/url', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Url::consultaUrl($request), 'application/json');
    }
]);

$obRouter->patch('/api/v1/url/{idUrl}', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idUrl)
    {
        return new Response(200, Url::updateUrl($request, $idUrl), 'application/json');
    }
]);

$obRouter->delete('/api/v1/url/{idUrl}', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request, $idUrl)
    {
        return new Response(200, Url::deleteUrl($request, $idUrl), 'application/json');
    }
]);