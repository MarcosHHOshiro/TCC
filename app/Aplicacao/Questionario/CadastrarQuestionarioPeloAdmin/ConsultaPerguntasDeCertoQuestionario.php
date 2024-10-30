<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaPerguntasDeCertoQuestionario
{
    public function executa($request, $idQuestionario)
    {
        $queryParams = $request->getQueryParams();
        if(empty($queryParams['tipo'])){
            throw new \Exception("Informe o tipo!");
        }

        $repositorio = new RepositorioDeQuestionarioComPdo();

        $repositorio->setTable("tb_questionario");
        $items = $repositorio->selectPadrao("tb_questionario.id_questionario = ? and tipo = ?", 
        "tb_questionario.id_questionario, titulo, tb_questionario.descricao, data_inicio, data_fim,
        json_agg(json_build_object(
	    'id_pergunta', tb_perguntas.id_pergunta, 
	    'pergunta', tb_perguntas.descricao, 
	    'justificativa', tb_perguntas.justificativa, 
	    'principio', tb_principio.descricao)) as perguntas", 
        "INNER JOIN tb_perguntas ON tb_questionario.id_questionario = tb_perguntas.id_questionario
        LEFT JOIN tb_principio ON tb_perguntas.id_principio = tb_principio.id_principio",
        'tb_questionario.id_questionario',
        [$idQuestionario, $queryParams['tipo']], null)->fetch(PDO::FETCH_ASSOC);

        if(empty($items)){
            throw new \Exception("Sem cadastro para essa consulta", 200);
        }

        $items['perguntas'] = json_decode($items['perguntas'], true);
        return $items;
    }   
}