<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use Exception;
use PDO;

class CadastraRespostaQuestionario
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();
        $headers = $request->getHeaders();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);

        $this->verificacoes($postVars, $idUsuario);
        
        $repositorioGeral->setTable('tb_resposta');
        $repositorioGeral->inserPadrao([
            "id_usuario" => $idUsuario,
            "id_pergunta" => $postVars['id_pergunta'],
            "resposta" => $postVars['resposta'],
            "descricao" => $postVars['descricao'],
        ]);

        return[
            "sucesso" => "Pergunta respondida!"
        ];
    }

    private function verificacoes($postVars, $idUsuario)
    {
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();
        
        $repositorioGeral->setTable('tb_resposta');
        $dados = $repositorioGeral->selectQueryCompleta("SELECT 1 FROM tb_resposta where id_pergunta = ? and id_usuario = ?", [$postVars['id_pergunta'], $idUsuario])->fetch(PDO::FETCH_ASSOC);
    
        if(!empty($dados))
        {
            throw new Exception("Pergunta já respondida por esse usuário!");
        }

        return;
    }
}