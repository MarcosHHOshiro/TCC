<?php

namespace App\Aplicacao\Questionario\CadastrarQuestionarioPeloAdmin;

use App\Dominio\Questionario\Questionario;
use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;
use PhpParser\Node\Stmt\Return_;

class UpdateQuestionario
{
    public function executa($request, $idQuestionario)
    {
        $postVars = $request->getPostVars();
        $this->verificaSeTemPeloMenosUmQuestionarioVinculado($idQuestionario, $postVars);

        $obQuestionario = new Questionario;
        $obQuestionario->setTitulo($postVars['titulo']);
        $obQuestionario->setDescricao($postVars['descricao']);
        $obQuestionario->setDataFim($postVars['data_fim']);
        $obQuestionario->setStatus($postVars['status']);
        $obQuestionario->setPadrao($postVars['padrao']);

        $repositorio = new RepositorioDeQuestionarioComPdo();
        $repositorio->updateQuestionario($obQuestionario, $idQuestionario);

        return [
            "sucesso" => "Cadastro atualizado com sucesso!"
        ];
    }

    private function verificaSeTemPeloMenosUmQuestionarioVinculado($idQuestionario, $postVars)
    {
        $obQuestionario = new RepositorioDeQuestionarioComPdo;

        if($postVars['padrao'] == 0 or $postVars['status'] = 'I'){
            $quantidade = $obQuestionario->selectQueryCompleta("SELECT count(id_questionario) from tb_questionario where
            tipo = (select tipo from tb_questionario where id_questionario = ?) and padrao = true and status = 'A'",
                [$idQuestionario]
            )->fetchColumn();
    
            if ($quantidade <= 1) {
                throw new \Exception("É necessário que tenha pelo menos um questionário/checklist padrão ativo!");
            }
    
        }

        return;
        // if ($postVars['tipo'] == 'Q') {
        //     $obQuestionario->updatePadrao(
        //         "padrao = true and id_questionario !=? and tipo = 'Q'",
        //         [
        //             'status' => 'I'
        //         ],
        //         [$idQuestionario]
        //     );
        // }

        // if ($postVars['tipo'] == 'C') {
        //     $obQuestionario->updatePadrao(
        //         "padrao = true and id_questionario !=? and tipo = 'C'",
        //         [
        //             'status' => 'I'
        //         ],
        //         [$idQuestionario]
        //     );
        // }
    }
}