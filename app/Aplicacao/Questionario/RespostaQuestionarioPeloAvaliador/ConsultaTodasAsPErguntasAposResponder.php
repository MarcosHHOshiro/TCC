<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaTodasAsPErguntasAposResponder
{
    public function executa($request, $idQuestionario)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        $idUsuarioLogado = $repositorioGeral->pegaIdUsuarioLogado($headers);
        $dados = $repositorioGeral->selectQueryCompleta("SELECT tb_questionario.id_questionario,
                json_agg(json_build_object(
                    'id_pergunta', tb_perguntas.id_pergunta,
                	'descricao', tb_perguntas.descricao,
                	'justificativa', justificativa,	
                	'descricao_resposta', tb_resposta.descricao,
                	'resposta', resposta
                )) as perguntas
                from rl_acesso_questionario
                inner join tb_url on rl_acesso_questionario.id_url = tb_url.id_url
                inner join tb_questionario on tb_url.id_url = tb_questionario.id_url
                inner join tb_perguntas on tb_questionario.id_questionario = tb_perguntas.id_questionario
                inner join tb_resposta on tb_perguntas.id_pergunta = tb_resposta.id_pergunta
                where rl_acesso_questionario.id_usuario = ? AND tb_questionario.id_questionario = ?
                group by tb_questionario.id_questionario
                ", [$idUsuarioLogado, $idQuestionario])->fetch(PDO::FETCH_ASSOC);

        if(empty($dados))
        {
            throw new \Exception("Sem cadastro para essa consulta!");
        }

        $dados['perguntas'] = json_decode($dados['perguntas'],  true);

        return  $dados;
    }
}