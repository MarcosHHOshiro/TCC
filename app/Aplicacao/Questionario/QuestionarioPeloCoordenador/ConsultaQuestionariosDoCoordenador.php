<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaQuestionariosDoCoordenador
{
    public function executa($request)
    {
        $repositorio = new RepositorioDeQuestionarioComPdo();
        $idUser = $repositorio->pegaIdUsuarioLogado($request->getHeaders());

        $repositorio->setTable("tb_questionario");
        $items = $repositorio->selectPadrao(
            "tipo = 'Q' and id_usuario_criou = ?",
            "tb_questionario.id_questionario, titulo, tb_questionario.descricao, data_inicio, data_fim, 
            padrao, status, id_url",
            null,
            'tb_questionario.id_questionario',
            [$idUser],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($items)) {
            throw new \Exception("Sem cadastro para essa consulta", 200);
        }

        return $items;
    }
}