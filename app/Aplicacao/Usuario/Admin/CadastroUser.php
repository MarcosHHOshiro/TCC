<?php

namespace App\Aplicacao\Usuario\Admin;

use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Exception;

class CadastroUser
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
     
        if($postVars['permissao'] == "U"){
            $permissao = "U";
        }else if($postVars['permissao'] == "C"){
            $permissao = "C";
        }else if($postVars['permissao'] == "A"){
            $permissao = "A";
        }else{
            throw new Exception("Informe valores permitidos!");
        }

        $this->verificaSeJaExisteEsseUsuario($postVars['login']);   

        $obUsuario = new Usuario;
        
        $obProfissao= new Profissao();
        $obProfissao->setIdProfissao(empty($postVars["id_profissao"]) ? null : $postVars["id_profissao"]);
        
        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setIdEscolaridade(empty($postVars["id_escolaridade"]) ? null : $postVars["id_escolaridade"]);

        $obUsuario->setNomeUsuario($postVars["nome_usuario"]);
        $obUsuario->setEmail($postVars["email"]);
        $obUsuario->setProfissao($obProfissao);
        $obUsuario->setEscolaridade($obEscolaridade);
        $obUsuario->setDataNascimento($postVars["data_nascimento"]);
        $obUsuario->setSexo($postVars["sexo"]);
        // $obUsuario->setIdCidade($postVars["id_cidade"]);
        $obUsuario->setLogin($postVars["login"]);
        $obUsuario->setPermissao($permissao);
        $obUsuario->setPermitido('true');
        $obUsuario->setSenha(password_hash($postVars["senha"], PASSWORD_DEFAULT));
        $obUsuario->setStatusUsuario($postVars["status_usuario"]);

        $useCase = new UsuarioPdo();
        $useCase->cadastro($obUsuario);

        return[
            'sucesso' => 'Cadastro realizado com sucesso!'
        ];
    }

    private function verificaSeJaExisteEsseUsuario(string $nomeUsuario)
    {
        $repositorio = new UsuarioPdo();

        $repositorio->setTable("tb_usuario");
        $temUsuario = $repositorio->selectPadrao("login = ?", "1", null, null, [$nomeUsuario], null)->fetchColumn();

        if(!empty($temUsuario)){
            throw new Exception("Nome de usuário já utilizado!");
        }

        return;
    }
}