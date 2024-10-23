<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;
use PDO;

class AvaliadoresVinculadosAUmQustionario
{
    public function executa($request, $idQuestionario)
    {
        $postVars = $request->getPostVars();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable("rl_acesso_questionario");
        $questionario = $repositorioGeral->selectPadrao(
            "tb_questionario.id_questionario = ?",
            "tb_questionario.id_questionario,
            json_agg(
         json_build_object(
			 'nome_usuario', nome_usuario,
		 	'id_usuario', tb_usuario.id_usuario
		 )) as usuarios",

            "inner join tb_questionario on rl_acesso_questionario.id_questionario = tb_questionario.id_questionario
        inner join tb_usuario on rl_acesso_questionario.id_usuario = tb_usuario.id_usuario",

            'tb_questionario.id_questionario',
            [$idQuestionario],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($questionario)) {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $questionario;
    }
}