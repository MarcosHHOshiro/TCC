<?php

namespace App\Aplicacao\Usuario\Admin;

use App\Infra\Usuario\UsuarioPdo;
use PDO;

class ConsultaDarPermitido
{
    public function executa($request){
        $repositorio = new UsuarioPdo;

        $repositorio->setTable("tb_usuario");
        $dados = $repositorio->selectPadrao("permitido = false", "id_usuario, nome_usuario", null, null, [], null)->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }
}