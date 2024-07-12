<?php

namespace App\Controller;
use App\Aplicacao\Url\CadastroUrl;
use App\Aplicacao\Url\ConsultaUrl;
use App\Aplicacao\Url\DeleteUrl;
use App\Aplicacao\Url\UpdateUrl;
use Http\Request;

class Url
{
    public static function cadastroUrl(Request $request)
    {
        $useCase = new CadastroUrl();
        $useCase->executa($request);

        return [
            'sucesso' => 'Cadastro realizado com sucesso'
        ];
    }

    public static function consultaUrl($request)
    {
        $useCase = new ConsultaUrl();
        return $useCase->executa($request);
    }

    public static function updateUrl($request, $idUrl)
    {
        $useCase = new UpdateUrl();
        $resultado = $useCase->executa($request, $idUrl);

        if($resultado){
            return [
                'sucesso' => 'Cadastro alterado com sucesso!'
            ];
        }else{
            throw new \Exception('Erro ao realizar atualização!', 500);
        }
    }

    public static function deleteUrl($request, $idUrl)
    {
        $url = new DeleteUrl();
        $profissoesUsuario = $url->executa($idUrl);

        // if(!empty($profissoesUsuario))
        // {
        //     throw new \Exception("Não é possível deletar esta profissao, pois existem usuários que a utizam!");
        // }

        return [
            'sucesso' => 'Cadastro deletado com sucesso!'
        ];
    }

}