<?php

namespace App\Aplicacao\Usuario\Admin;

use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Exception;
use Http\Request;

class DaPermitidoParaUsuarioAutoCadastrado
{
    public function executa(Request $request, int $idUsuario)
    {
        $postVars = $request->getPostVars();

        $obUsuario = new Usuario();
        $obUsuario->setPermitido('true');

        $repostirioUsuario = new UsuarioPdo();
        $repostirioUsuario->setTable('tb_usuario');
        $result = $repostirioUsuario->updatePadrao('id_usuario = ?', ['permitido' =>  $obUsuario->getPermitido()], [$idUsuario]);

        if($result == true){
            return["sucesso" => "Permissão concedida!"];
        }else{
            throw new Exception("Erro ao dar update!");
        }
    }
}