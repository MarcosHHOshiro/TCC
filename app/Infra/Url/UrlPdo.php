<?php

namespace App\Infra\Url;

use app\Dominio\Url\Url;
use Db\DataBase;
use Exception;
use PDO;

class UrlPdo
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function cadastro(Url $url) : int
    {
        $this->db->setTable("tb_url");
        $idUrl = ($this->db)->insert([
            'url' =>        $url->getUrl(),
            'descricao' =>  $url->getDescricao(),
            'tipo_site' =>  $url->getTipoSite()
        ]);

        return $idUrl;
    }

    public function selectPadrao() : array
    {
        $this->db->setTable("tb_url");
        $urls = $this->db->selectJoinPersonalizavel(
            null,
            "url, descricao, tipo_site",
            null,
            null,
            [],
            null
        )->fetchAll(PDO::FETCH_ASSOC);

        if(empty( $urls )) {
            throw new Exception("Sem cadastro para essa consulta!");
        }

        return $urls;
    }

    public function update(Url $url) : bool
    {
        $this->db->setTable("tb_url");
        
        $depositoArray = [
            'url' =>        $url->getUrl(),
            'descricao' =>  $url->getDescricao(),
            'tipo_site' =>  $url->getTipoSite()
        ];

        return $this->db->update2("id_url = ?", $depositoArray, [$url->getIdUrl()]);
    }

    public function deleta(int $idUrl) : bool
    {
        $this->db->setTable("tb_url");
        
        return $this->db->delete("id_url = ?", [$idUrl]);
    }
}