<?php

namespace App\Aplicacao\Usuario;

use App\Infra\Usuario\UsuarioPdo;
use Firebase\JWT\JWT;
use Http\Request;

class AuthUsuario
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        if (!isset($postVars['login']) or !isset($postVars['senha'])) {
            throw new \Exception("Os campos 'login' e 'senha' são obrigatorios", 401);
        }
        
        $useCase = new UsuarioPdo();
        $senha = $useCase->consultaParaLogin($postVars['login']);

        if (!password_verify($postVars['senha'], $senha)) {
            throw new \Exception("Usuário ou senha incorreto!", 401);
        }

        $payload = [
            "exp" => time() + 60 * 60 * 24,
            // "ultima_acao" => time(),
            'login' => $postVars['login'],
            // 'user' => $obUsuario->getIdUsuario(),
            // 'grupo' => $obUsuario->getNomeGrupo()
        ];

        return [
            'token' => JWT::encode($payload, getenv('JWT_KEY'), 'HS256'),
        ];

    }
}