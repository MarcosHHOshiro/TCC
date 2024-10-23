<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class CadastroAcessoQuestionario
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        foreach ($postVars['usuarios'] as $usuario) {
            $repositorioGeral->setTable("tb_usuario");
            $usuarios = $repositorioGeral->insertPadrao([
                'id_questionario' => $postVars['id_questionario'],
                'id_usuario' => $usuario
            ]);
        }

        return $usuarios;
    }
}