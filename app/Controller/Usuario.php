<?php

namespace App\Controller;

use App\Aplicacao\Usuario\Admin\ConsultaDarPermitido;
use App\Aplicacao\Usuario\Admin\DaPermitidoParaUsuarioAutoCadastrado;
use App\Aplicacao\Usuario\Admin\DarPermitido;
use App\Aplicacao\Usuario\AuthUsuario;
use App\Aplicacao\Usuario\CadastraProfissao;
use App\Aplicacao\Usuario\CadastraUsuario;
use App\Aplicacao\Usuario\CadastroEscolaridade;
use App\Aplicacao\Usuario\ConsultaEscolaridade;
use App\Aplicacao\Usuario\ConsultaProfissao;
use App\Aplicacao\Usuario\ConsultaUsuario;
use App\Aplicacao\Usuario\DeleteProfissao;
use App\Aplicacao\Usuario\updateEscolaridade;
use App\Aplicacao\Usuario\UpdateProfissao;
use App\Aplicacao\Usuario\UpdateUsuario;
use Http\Request;

class Usuario
{

    public static function teste($request)
    {
        return "teste rotas";
    }

    public static function cadastroUsuario(Request $request)
    {
        $useCase = new CadastraUsuario();
        $useCase->executa($request);

        return [
            'sucesso' => 'Cadastro realizado com sucesso'
        ];
    }

    public static function consultaUsuario($request)
    {
        $useCase = new ConsultaUsuario();
        return $useCase->executa($request);
    }

    public static function updateUsuario($request, $idUsuario)
    {
        $useCase = new UpdateUsuario();
        $resultado = $useCase->executa($request, $idUsuario);

        if($resultado){
            return [
                'sucesso' => 'Cadastro realizado com sucesso!'
            ];
        }else{
            throw new \Exception('Erro ao realizar atualização!', 500);
        }

    }

    /**
     * Profissao
     */
    public static function consultaProfissao($request)
    {
        $useCase = new ConsultaProfissao();
        return $useCase->executa($request);
    }

    public static function cadastroProfissao(Request $request)
    {
        $useCase = new CadastraProfissao();
        $useCase->executa($request);

        return [
            'sucesso' => 'Cadastro realizado com sucesso!'
        ];
    }

    public static function updateProfissao($request, $idProfissao)
    {
        $useCase = new UpdateProfissao();
        $useCase->executa($request, $idProfissao);

        return [
            'sucesso' => 'Cadastro alterado com sucesso!'
        ];
    }

    public static function deleteProfissao($request, $idProfissao)
    {
        $useCase = new DeleteProfissao();
        if ($useCase->executa($idProfissao)) {
            return [
                'sucesso' => 'Cadastro deletado com sucesso!'
            ];
        } else {
            throw new \Exception('Erro ao deletar!');
        }
    }


    /**
     * Escolaridade
     */
    public static function consultaEscolaridade($request)
    {
        $useCase = new ConsultaEscolaridade();
        return $useCase->executa($request);
    }

    public static function cadastroEscolaridade($request)
    {
        $useCase = new CadastroEscolaridade();
        $useCase->executa($request);

        return [
            'sucesso' => 'Cadastro realizado com sucesso'
        ];
    }

    public static function updateEscolaridade($request, $idEscolaridade)
    {
        $useCase = new updateEscolaridade();
        $useCase->executa($request, $idEscolaridade);

        return [
            'sucesso' => 'Cadastro alterado com sucesso!'
        ];
    }

    public static function authUsuario($request)
    {
        $useCase = new AuthUsuario();
        return $useCase->executa($request);
    }

    public static function consultaDeUsuarioQueFizeramOproprioCadastro($request)
    {
        $useCase = new ConsultaDarPermitido();
        return $useCase->executa($request);
    }

    public static function daPermitidoParaUsuarioAutoCadastro($request, $idUsuario)
    {
        $useCase = new DaPermitidoParaUsuarioAutoCadastrado();
        return $useCase->executa($request, $idUsuario);
    }
}