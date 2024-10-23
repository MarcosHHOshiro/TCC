<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class CadastroAcessoQuestionario
{
    public function executa($request)
    {
        $postVars = $request->getPostVars();

        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->beginTransaction();
        foreach ($postVars['usuarios'] as $usuario) {
            $repositorioGeral->setTable("rl_acesso_questionario");
            $verificaSeJaTemCadastro = $repositorioGeral->selectPadrao("rl_acesso_questionario.id_usuario = ? and id_questionario = ?", "nome_usuario", 
            'inner join tb_usuario on rl_acesso_questionario.id_usuario = tb_usuario.id_usuario', null, 
            [$usuario, $postVars['id_questionario']], null)->fetchColumn();
            
            if(!empty($verificaSeJaTemCadastro))
            {
                throw new \Exception("O usuario {$verificaSeJaTemCadastro} já foi cadastrado!");
            }

            $usuarios = $repositorioGeral->insertPadrao([
                'id_questionario' => $postVars['id_questionario'],
                'id_usuario' => $usuario
            ]);
        }

        $repositorioGeral->commit();
        return [
            "sucesso" => "Cadastro realizado com sucesso!"
        ];
    }
}