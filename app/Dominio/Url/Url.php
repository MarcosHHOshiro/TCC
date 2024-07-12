<?php

namespace app\Dominio\Url;

class Url{
    private $id_url;
    private $url;
    private $descricao;
    private $tipo_site;

    /**
     * Get the value of tipo_site
     */
    public function getTipoSite() {
        return $this->tipo_site;
    }

    /**
     * Set the value of tipo_site
     */
    public function setTipoSite($tipo_site): self {
        $this->tipo_site = $tipo_site;
        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao($descricao): self {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($url): self {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the value of id_url
     */
    public function getIdUrl() {
        return $this->id_url;
    }

    /**
     * Set the value of id_url
     */
    public function setIdUrl($id_url): self {
        $this->id_url = $id_url;
        return $this;
    }
}