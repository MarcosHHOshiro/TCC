<?php

namespace App\Aplicacao\Usuario;

use App\Infra\Usuario\ProfissaoPdo;
use Http\Request;

class DeleteProfissao
{
    public function executa(int $idProfissao)
    {
        // $postVars = $request->getPostVars();
        $this->verificaSeExisteProfissaoVinculadaAoUsuario($idProfissao);

        $banco = new ProfissaoPdo();
        return $banco->deleta($idProfissao);
    }

    private function verificaSeExisteProfissaoVinculadaAoUsuario($idProfissao)
    {
        $banco = new ProfissaoPdo();
        $profissoesUsuario = $banco->consultaProfissaoEUsuario($idProfissao);

        if(!empty($profissoesUsuario))
        {
            throw new \Exception("Não é possível deletar esta profissao, pois existem usuários que a utizam!");
        }
    }
}