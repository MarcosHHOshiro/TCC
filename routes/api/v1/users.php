<?php
namespace Routes\api\v1;

use Http\Response;
use \App\Controller\Usuario;

$obRouter->get('/api/v1/users', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Usuario::teste($request), 'application/json');
    }
]);
