<?php

namespace App\Aplicacao\Usuario;

use App\Dominio\Usuario\Escolaridade;
use App\Dominio\Usuario\Profissao;
use App\Dominio\Usuario\Usuario;
use App\Infra\Usuario\UsuarioPdo;
use FFI\Exception;
use Http\Request;

class UpdateUsuario
{
    public function executa(Request $request, int $idUsuario)
    {
        $postVars = $request->getPostVars();
        $obUsuario = new Usuario();

        $obProfissao = new Profissao();
        $obProfissao->setIdProfissao($postVars["id_profissao"]);
        $viaCep = $this->buscaCidadeEstadoPeloCep($postVars['cep']);

        $obEscolaridade = new Escolaridade();
        $obEscolaridade->setIdEscolaridade($postVars["id_escolaridade"]);

        $obUsuario->setNomeUsuario($postVars["nome_usuario"]);
        $obUsuario->setEmail($postVars["email"]);
        $obUsuario->setProfissao($obProfissao);
        $obUsuario->setEscolaridade($obEscolaridade);
        $obUsuario->setDataNascimento($postVars["data_nascimento"]);
        $obUsuario->setSexo($postVars["sexo"]);
        // $obUsuario->setIdCidade($postVars["id_cidade"]);
        // $obUsuario->setLogin($postVars["login"]);
        // $obUsuario->setSenha(password_hash($postVars["senha"], PASSWORD_DEFAULT));
        // $obUsuario->setNivelAcesso($postVars["nivel_acesso"]);
        $obUsuario->setStatusUsuario($postVars["status_usuario"]);
        $obUsuario->setCidade($viaCep['localidade']);
        $obUsuario->setEstado($viaCep["estado"]);

        $useCase = new UsuarioPdo();
        return $useCase->update($obUsuario, $idUsuario);
    }

    private function buscaCidadeEstadoPeloCep($cep)
    {
        $url = "https://viacep.com.br/ws/$cep/json/";

        if (empty($cep)) {
            throw new Exception("Informe o cep!", 400);
        }

        // Faz a requisição e obtém o conteúdo JSON
        $response = file_get_contents($url);

        // Converte o JSON em um array associativo
        $endereco = json_decode($response, true);

        // Verifica se a consulta foi bem-sucedida e imprime o resultado
        if (isset($endereco['erro']) && $endereco['erro'] === true) {
            throw new Exception("CEP não encontrado.");
        } else {
            return $endereco;
        }
    }
}