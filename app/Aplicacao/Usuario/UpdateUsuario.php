<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Http\Request;

class UpdateUsuario
{
    public function executa(Request $request, int $idUsuario)
    {
        $postVars = $request->getPostVars();
        $obUsuario = new Usuario();
        
        $obProfissao= new Profissao();
        $obProfissao->setIdProfissao($postVars["id_profissao"]);
        
        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setIdEscolaridade($postVars["id_escolaridade"]);

        $obUsuario->setNomeUsuario($postVars["nome_usuario"]);
        $obUsuario->setEmail($postVars["email"]);
        $obUsuario->setProfissao($obProfissao);
        $obUsuario->setEscolaridade($obEscolaridade);
        $obUsuario->setDataNascimento($postVars["data_nascimento"]);
        $obUsuario->setSexo($postVars["sexo"]);
        // $obUsuario->setIdCidade($postVars["id_cidade"]);
        // $obUsuario->setLogin($postVars["login"]);
        // $obUsuario->setSenha(password_hash($postVars["senha"], PASSWORD_DEFAULT));
        // $obUsuario->setNivelAcesso($postVars["nivel_acesso"]);
        $obUsuario->setStatusUsuario($postVars["status_usuario"]);

        $useCase = new UsuarioPdo();
        return $useCase->update($obUsuario, $idUsuario);
    }
}