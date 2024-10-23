<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaQuestionariosQueOUsuarioTemAcesso
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);

        $repositorioGeral->setTable("rl_acesso_questionario");
        $questionarios = $repositorioGeral->selectPadrao("id_usuario = ?",
         "id_usuario, 
         json_agg(
         json_build_object(
			 'titulo', titulo,
		 	'id_questionario', tb_questionario.id_questionario,
            'descricao' , descricao
		 )) as questionarios", 
          "INNER JOIN tb_questionario ON rl_acesso_questionario.id_questionario = tb_questionario.id_questionario",
           "rl_acesso_questionario.id_usuario", [$idUsuario], null)->fetch(PDO::FETCH_ASSOC);

        $questionarios['questionarios'] = json_decode($questionarios['questionarios'], true);

        return $questionarios;
    }
}