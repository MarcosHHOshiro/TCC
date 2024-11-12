<?php

namespace App\Aplicacao\Questionario\QuestionarioPeloCoordenador;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaAvaliadores
{
    public function executa($request, $idUrl)
    {
        $postVars = $request->getPostVars();
        
        $repositorioGeral = new RepositorioDeQuestionarioComPdo();

        $repositorioGeral->setTable("tb_usuario");
        $usuarios = $repositorioGeral->selectQueryCompleta("SELECT tb_usuario.id_usuario, nome_usuario, permissao 
            FROM tb_usuario 
            WHERE permissao = 'U' 
              AND tb_usuario.id_usuario NOT IN (
                  SELECT id_usuario 
                  FROM rl_acesso_questionario 
                  WHERE id_url = ?
            );", [$idUrl])->fetchAll(PDO::FETCH_ASSOC);
    
        if(empty($usuarios))
        {
            throw new \Exception("Sem cadastro para essa consulta");
        }

        return $usuarios;
    }
}