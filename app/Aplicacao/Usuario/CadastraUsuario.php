<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use Exception;
use Http\Request;

class CadastraUsuario
{
    public function executa(Request $request)
    {
        $postVars = $request->getPostVars();

        if ($postVars['permissao'] == "U") {
            $permissao = "U";
        } else if ($postVars['permissao'] == "C") {
            $permissao = "C";
        } else {
            throw new Exception("Informe valores permitidos!");
        }

        $this->verificaSeJaExisteEsseUsuario($postVars['login']);
        $viaCep = $this->buscaCidadeEstadoPeloCep($postVars['cep']);

        $obUsuario = new Usuario();

        $obProfissao = new Profissao();
        $obProfissao->setIdProfissao(empty($postVars["id_profissao"]) ? null : $postVars["id_profissao"]);

        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setIdEscolaridade(empty($postVars["id_escolaridade"]) ? null : $postVars["id_escolaridade"]);

        $obUsuario->setNomeUsuario($postVars["nome_usuario"]);
        $obUsuario->setEmail($postVars["email"]);
        $obUsuario->setProfissao($obProfissao);
        $obUsuario->setEscolaridade($obEscolaridade);
        $obUsuario->setDataNascimento($postVars["data_nascimento"]);
        $obUsuario->setSexo($postVars["sexo"]);
        // $obUsuario->setIdCidade($postVars["id_cidade"]);
        $obUsuario->setLogin($postVars["login"]);
        $obUsuario->setSenha(password_hash($postVars["senha"], PASSWORD_DEFAULT));
        $obUsuario->setPermissao($permissao);
        $obUsuario->setPermitido('false');
        $obUsuario->setStatusUsuario($postVars["status_usuario"]);
        $obUsuario->setCidade($viaCep['localidade']);
        $obUsuario->setEstado($viaCep["estado"]);

        $useCase = new UsuarioPdo();
        return $useCase->cadastro($obUsuario);
    }

    private function verificaSeJaExisteEsseUsuario(string $nomeUsuario)
    {
        $repositorio = new UsuarioPdo();

        $repositorio->setTable("tb_usuario");
        $temUsuario = $repositorio->selectPadrao("login = ?", "1", null, null, [$nomeUsuario], null)->fetchColumn();

        if (!empty($temUsuario)) {
            throw new Exception("Nome de usuário já utilizado!");
        }

        return;
    }

    private function buscaCidadeEstadoPeloCep($cep)
    {
        $url = "https://viacep.com.br/ws/$cep/json/";

        if(empty($cep))
        {
            throw new Exception("Informe o cep!", 400);
        }

        // Faz a requisição e obtém o conteúdo JSON
        $response = file_get_contents($url);

        // Converte o JSON em um array associativo
        $endereco = json_decode($response, true);

        // Verifica se a consulta foi bem-sucedida e imprime o resultado
        if (isset($endereco['erro']) && $endereco['erro'] === true) {
            throw new Exception( "CEP não encontrado.");
        } else {
            return $endereco;  
        }
    }
}