<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;
use PDO;

class ConsultaUrlQueOUsuarioTemAcesso
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $header = $request->getHeaders();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($header);
        $dados = $repositorioGeral->selectQueryCompleta("SELECT tb_url.id_url, url, data_inicio, data_fim,
        respondeu_questionario, respondeu_checklist,
        (SELECT id_questionario from tb_questionario as tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'Q') as id_questionario,
        (SELECT id_questionario from tb_questionario as tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'C') as id_checklist
        from tb_url
            inner join rl_acesso_questionario on rl_acesso_questionario.id_url = tb_url.id_url
            where rl_acesso_questionario.id_usuario = ?
            AND data_inicio <= CURRENT_DATE
            AND (data_fim IS NULL OR data_fim >= CURRENT_DATE)
        order by tb_url.id_url", [$idUsuario])->fetchAll(PDO::FETCH_ASSOC);

        if (empty($dados)) {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $dados;

    }
}