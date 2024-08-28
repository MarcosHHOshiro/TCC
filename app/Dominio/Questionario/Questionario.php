<?php

namespace app\Dominio\Questionario;
use app\Dominio\Url\Url;
use app\Dominio\Usuario\Escolaridade;
use app\Dominio\Usuario\Profissao;
use app\Dominio\Usuario\Usuario;

class Questionario{
    private $id_questionario;
    private $titulo;
    private $descricao;
    private Usuario $usuario;
    private $padrao;
    private $data_inicio;
    private $data_fim;
    private $status;
    private $tipo;

    private Profissao $profissao;
    private Escolaridade $escolaridade;

    /**
     * Get the value of id_questionario
     */
    public function getIdQuestionario()
    {
        return $this->id_questionario;
    }

    /**
     * Set the value of id_questionario
     */
    public function setIdQuestionario($id_questionario): self
    {
        $this->id_questionario = $id_questionario;

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
     * Get the value of usuario
     *
     * @return Usuario
     */
    public function getUsuario(): Usuario {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @param Usuario $usuario
     *
     * @return self
     */
    public function setUsuario(Usuario $usuario): self {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * Get the value of profissao
     *
     * @return Profissao
     */
    public function getProfissao(): Profissao {
        return $this->profissao;
    }

    /**
     * Set the value of profissao
     *
     * @param Profissao $profissao
     *
     * @return self
     */
    public function setProfissao(Profissao $profissao): self {
        $this->profissao = $profissao;
        return $this;
    }

    /**
     * Get the value of escolaridade
     *
     * @return Escolaridade
     */
    public function getEscolaridade(): Escolaridade {
        return $this->escolaridade;
    }

    /**
     * Set the value of escolaridade
     *
     * @param Escolaridade $escolaridade
     *
     * @return self
     */
    public function setEscolaridade(Escolaridade $escolaridade): self {
        $this->escolaridade = $escolaridade;
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
        if($status != "A" and $status != "I")
        {
            throw new \Exception("Informe um status válido!");
        }

        $this->status = $status;

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
        if($tipo != "Q" and $tipo != "I")
        {
            throw new \Exception("Informe um tipo válido!");
        }
        

        $this->tipo = mb_strtoupper($tipo);

        return $this;
    }
}