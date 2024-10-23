<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaAvaliadores
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable("tb_usuario");
        $usuarios = $repositorioGeral->selectPadrao("permissao = 'A'", "id_usuario, nome_usuario, permissao", null, null, [], null)->fetchAll(PDO::FETCH_ASSOC);
    
        return $usuarios;
    }
}