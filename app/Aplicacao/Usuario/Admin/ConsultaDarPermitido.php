<?php

namespace App\Aplicacao\Usuario\Admin;

use App\Infra\Usuario\UsuarioPdo;
use Exception;
use PDO;

class ConsultaDarPermitido
{
    public function executa($request){
        $repositorio = new UsuarioPdo;

        $repositorio->setTable("tb_usuario");
        $dados = $repositorio->selectPadrao("permitido = false", "id_usuario, nome_usuario, email, permissao as tipo", null, null, [], null)->fetchAll(PDO::FETCH_ASSOC);

        if(empty($dados)){
            throw new Exception("Sem cadastro para essa consulta!", 200);
        }

        return $dados;
    }
}