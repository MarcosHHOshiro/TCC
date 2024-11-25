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
        $repositorioGeral->beginTransaction();
        $idUsuario = $repositorioGeral->pegaIdUsuarioLogado($headers);
        $dadosQTD = $this->pegaQuantidadeETipo($postVars);
        $this->verificacoes($postVars, $idUsuario, $dadosQTD['id_url']);

        if ($dadosQTD['count'] <= 1) {
            $repositorioGeral->setTable('rl_acesso_questionario');
            if ($dadosQTD['tipo'] == "Q") {
                $repositorioGeral->updatePadrao(
                    "id_url = ? and id_usuario = ?",
                    [
                        'respondeu_questionario' => 'true'
                    ],
                    [$dadosQTD['id_url'], $idUsuario]
                );
            }
            if ($dadosQTD['tipo'] == "C") {
                $repositorioGeral->updatePadrao(
                    "id_url = ? and id_usuario = ?",
                    [
                        'respondeu_checklist' => 'true'
                    ],
                    [$dadosQTD['id_url'], $idUsuario]
                );
            }
        }

        $repositorioGeral->setTable('tb_resposta');
        $repositorioGeral->inserPadrao([
            "id_usuario" => $idUsuario,
            "id_pergunta" => $postVars['id_pergunta'],
            "resposta" => $postVars['resposta'],
            "descricao" => $postVars['descricao'],
        ]);

        $repositorioGeral->commit();

        return [
            "sucesso" => "Pergunta respondida!"
        ];
    }

    private function verificacoes($postVars, $idUsuario, $idUrl)
    {
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable('tb_resposta');
        $dados = $repositorioGeral->selectQueryCompleta("SELECT 1 FROM tb_resposta where id_pergunta = ? and id_usuario = ?", [$postVars['id_pergunta'], $idUsuario])->fetch(PDO::FETCH_ASSOC);

        if (!empty($dados)) {
            throw new Exception("Pergunta já respondida por esse usuário!");
        }

        $temAcesso = $repositorioGeral->selectQueryCompleta("SELECT 1 from rl_acesso_questionario
        where id_usuario = ? and id_url = ?", 
        [$idUsuario, $idUrl])->fetch(PDO::FETCH_ASSOC);
        
        if (empty($temAcesso)) {
            throw new Exception("Você não tem acesso para responder!");
        }

        return;
    }

    private function pegaQuantidadeETipo($postVars)
    {
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable('tb_resposta');
        $dados = $repositorioGeral->selectQueryCompleta("SELECT tipo, count(tb_perguntas.id_questionario),
        id_url
         from tb_perguntas 
            inner join tb_questionario on tb_perguntas.id_questionario = tb_questionario.id_questionario
            left join tb_resposta on tb_perguntas.id_pergunta = tb_resposta.id_pergunta
            where tb_perguntas.id_questionario = (select tb_questionario.id_questionario from tb_perguntas
            inner join tb_questionario on tb_perguntas.id_questionario = tb_questionario.id_questionario
            WHERE id_pergunta = ?) and tb_resposta.id_resposta is null
             group by tb_questionario.tipo, id_url", [$postVars['id_pergunta']])->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }
}