<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Http\Request;

class CadastraUsuario
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();
        $obUsuario = new Usuario();

        $obUsuario->setNomeUsuario($postVars["nome_usuario"]);
        $obUsuario->setEmail($postVars["email"]);
        $obUsuario->setIdProfissao($postVars["id_profissao"]);
        $obUsuario->setIdEscolaridade($postVars["id_escolaridade"]);
        $obUsuario->setDataNascimento($postVars["data_nascimento"]);
        $obUsuario->setSexo($postVars["sexo"]);
        $obUsuario->setIdCidade($postVars["id_cidade"]);
        $obUsuario->setLogin($postVars["login"]);
        $obUsuario->setSenha($postVars["senha"]);
        $obUsuario->setNivelAcesso($postVars["nivel_acesso"]);
        $obUsuario->setStatusUsuario($postVars["status_usuario"]);

        $useCase = new UsuarioPdo();
        return $useCase->cadastro($obUsuario);
    }
}