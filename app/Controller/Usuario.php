<?php

namespace App\Controller;
use App\Aplicacao\Usuario\CadastraUsuario;
use Http\Request;

class Usuario{

    public static function teste($request)
    {
        return "teste rotas";
    }
    
    public static function cadastroUsuario(Request $request)
    {
        $useCase = new CadastraUsuario();
        $useCase->executa($request);
    }
}