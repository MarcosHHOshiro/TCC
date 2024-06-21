<?php

namespace App\Aplicacao\Usuario;

use App\Infra\Usuario\UsuarioPdo;
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
            throw new \Exception("O usuário, CPF/CNPJ ou senha incorreto!", 401);
        }

        
    }
}