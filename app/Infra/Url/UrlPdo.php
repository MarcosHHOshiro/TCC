<?php

namespace App\Infra\Url;

use app\Dominio\Url\Url;
use Db\DataBase;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDO;

class UrlPdo
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function cadastro(Url $url): int
    {
        $this->db->setTable("tb_url");
        $idUrl = ($this->db)->insert([
            'url' => $url->getUrl(),
            'descricao' => $url->getDescricao(),
            'tipo_site' => $url->getTipoSite(),
            'id_usuario' => $url->getIdUsuario(),
            'data_inicio' => $url->getDataInicio(),
            'data_fim' => $url->getDataFim()
        ]);

        return $idUrl;
    }

    public function selectPadrao($request): array
    {
        $header = $request->getHeaders();
        $idUsuario = $this->pegaIdUsuarioLogado($header);

        $this->db->setTable("tb_url");
        $urls = $this->db->selectJoinPersonalizavel(
            "id_usuario = ?",
            "url, descricao, tipo_site, id_url as id, data_inicio, data_fim,
            (select id_questionario as questionario from tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'Q'),
            (select id_questionario as checklist from tb_questionario where tb_questionario.id_url = tb_url.id_url and tipo = 'C')
            ",
            null,
            null,
            [$idUsuario],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($urls)) {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $urls;
    }

    public function update(Url $url): bool
    {
        $this->db->setTable("tb_url");

        $depositoArray = [
            'url' => $url->getUrl(),
            'descricao' => $url->getDescricao(),
            'tipo_site' => $url->getTipoSite()
        ];

        return $this->db->update2("id_url = ?", $depositoArray, [$url->getIdUrl()]);
    }

    public function deleta(int $idUrl): bool
    {
        $this->db->setTable("tb_url");

        return $this->db->delete("id_url = ?", [$idUrl]);
    }

    public function pegaIdUsuarioLogado($header)
    {
        $jwt = isset($header['Authorization']) ? str_replace('Bearer ', '', $header['Authorization']) : '';

        try {
            //decode
            $decode = (array) JWT::decode($jwt, new Key(getenv('JWT_KEY'), 'HS256'));
        } catch (Exception $e) {
            throw new Exception("Token invalido", 403);
        }
        $login = $decode['login'] ?? '';

        $this->db->setTable("tb_usuario");
        $id = $this->db->selectJoinPersonalizavel("login = ?", "id_usuario", null, null, [$login], null)->fetchColumn();

        return $id;
    }
}