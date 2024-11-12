<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;
use PDO;

class AvaliadoresVinculadosAUmQustionario
{
    public function executa($request, $idUrl)
    {
        $postVars = $request->getPostVars();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable("rl_acesso_questionario");
        $dados = $repositorioGeral->selectPadrao(
            "tb_url.id_url = ?",
            "tb_url.id_url, 
            (SELECT id_questionario from tb_questionario as tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'Q') as id_questionario,
            (SELECT id_questionario from tb_questionario as tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'C') as id_checklist,
            json_agg(
         json_build_object(
			 'nome_usuario', nome_usuario,
		 	'id_usuario', tb_usuario.id_usuario,
		 	'cidade', tb_usuario.cidade,
		 	'estado', tb_usuario.estado
		 )) as usuarios",

            "inner join tb_url on rl_acesso_questionario.id_url = tb_url.id_url
        inner join tb_usuario on rl_acesso_questionario.id_usuario = tb_usuario.id_usuario",

            'tb_url.id_url',
            [$idUrl],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($dados)) {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        foreach($dados as &$dado)
        {
            $dado['usuarios'] = json_decode($dado['usuarios'], true);
        }

        return $dados;
    }
}