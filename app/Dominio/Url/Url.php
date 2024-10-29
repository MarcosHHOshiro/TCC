<?php

namespace app\Dominio\Url;

use app\Dominio\Questionario\Questionario;

class Url{
    private $id_url;
    private $id_usuario;
    private $url;
    private $data_inicio;
    private $data_fim;
    private $descricao;
    private Questionario $questionario;
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
     * Get the value of questionario
     *
     * @return Questionario
     */
    public function getQuestionario(): Questionario {
        return $this->questionario;
    }

    /**
     * Set the value of questionario
     *
     * @param Questionario $questionario
     *
     * @return self
     */
    public function setQuestionario(Questionario $questionario): self {
        $this->questionario = $questionario;
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

    /**
     * Get the value of data_inicio
     */
    public function getDataInicio()
    {
        return $this->data_inicio;
    }

    /**
     * Set the value of data_inicio
     */
    public function setDataInicio($data_inicio): self
    {
        $this->data_inicio = $data_inicio;

        return $this;
    }

    /**
     * Get the value of data_fim
     */
    public function getDataFim()
    {
        return $this->data_fim;
    }

    /**
     * Set the value of data_fim
     */
    public function setDataFim($data_fim): self
    {
        $this->data_fim = $data_fim;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     */
    public function setIdUsuario($id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}