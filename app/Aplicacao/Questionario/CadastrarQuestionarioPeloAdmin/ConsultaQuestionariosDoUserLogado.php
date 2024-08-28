<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaQuestionariosDoUserLogado
{
    public function executa($request)
    {
        $repositorio = new RepositorioDeQuestionarioComPdo();
        $idUser = $repositorio->pegaIdUsuarioLogado($request->getHeaders());

        $repositorio->setTable("tb_questionario");
        $items = $repositorio->selectPadrao("tb_questionario.id_usuario_criou = ?", 
        "tb_questionario.id_questionario, titulo, tb_questionario.descricao, data_inicio, data_fim, padrao", 
        null,
        'tb_questionario.id_questionario',
        [$idUser], null)->fetchAll(PDO::FETCH_ASSOC);

        if(empty($items)){
            throw new \Exception("Sem cadastro para essa consulta", 200);
        }

        return $items;
    }
}