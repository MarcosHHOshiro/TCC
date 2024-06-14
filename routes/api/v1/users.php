<?php
namespace Routes\api\v1;

use Http\Response;
use \App\Controller\Usuario;

$obRouter->post('/api/v1/users', [
    'rolePermissao' => [
        '',
    ],
    'middlewares' => [
        // 'jwt-auth'
        // 'cache'  
    ],
    function ($request)
    {
        return new Response(200, Usuario::cadastroUsuario($request), 'application/json');
    }
]);
