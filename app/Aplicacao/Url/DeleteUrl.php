<?php

namespace App\Aplicacao\Url;

use App\Infra\Url\UrlPdo;

class DeleteUrl
{
    public function executa(int $idUrl)
    {
        // $postVars = $request->getPostVars();
        // $this->verificaSeExisteProfissaoVinculadaAoUsuario($idUrl);

        $banco = new UrlPdo();
        return $banco->deleta($idUrl);
    }
}