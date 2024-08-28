<?php

namespace app\Checklist\Questionario;

class Checklist{
    private $id_checklist;
    private $id_url;
    private $titulo;
    private $descricao;
    private $id_usuario_criou;
    private $padrao;
    private $data_inicio;
    private $data_fim;
    private $status;
    private $id_profissao;
    private $id_escolaridade;

    /**
     * Get the value of id_checklist
     */
    public function getIdChecklist()
    {
        return $this->id_checklist;
    }

    /**
     * Set the value of id_checklist
     */
    public function setIdChecklist($id_checklist): self
    {
        $this->id_checklist = $id_checklist;

        return $this;
    }

    /**
     * Get the value of id_url
     */
    public function getIdUrl()
    {
        return $this->id_url;
    }

    /**
     * Set the value of id_url
     */
    public function setIdUrl($id_url): self
    {
        $this->id_url = $id_url;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of id_usuario_criou
     */
    public function getIdUsuarioCriou()
    {
        return $this->id_usuario_criou;
    }

    /**
     * Set the value of id_usuario_criou
     */
    public function setIdUsuarioCriou($id_usuario_criou): self
    {
        $this->id_usuario_criou = $id_usuario_criou;

        return $this;
    }

    /**
     * Get the value of padrao
     */
    public function getPadrao()
    {
        return $this->padrao;
    }

    /**
     * Set the value of padrao
     */
    public function setPadrao($padrao): self
    {
        $this->padrao = $padrao;

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
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of id_profissao
     */
    public function getIdProfissao()
    {
        return $this->id_profissao;
    }

    /**
     * Set the value of id_profissao
     */
    public function setIdProfissao($id_profissao): self
    {
        $this->id_profissao = $id_profissao;

        return $this;
    }

    /**
     * Get the value of id_escolaridade
     */
    public function getIdEscolaridade()
    {
        return $this->id_escolaridade;
    }

    /**
     * Set the value of id_escolaridade
     */
    public function setIdEscolaridade($id_escolaridade): self
    {
        $this->id_escolaridade = $id_escolaridade;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     */
    public function setTipo($tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}