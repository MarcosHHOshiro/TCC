<?php

namespace App\Dominio\Questionario;

class Perguntas
{
    private $id_pergunta;
    private Questionario $questionario;
    private $descricao;
    private $justificativa;
    // private $id_principio;

    /**
     * Get the value of id_pergunta
     */
    public function getIdPergunta()
    {
        return $this->id_pergunta;
    }

    /**
     * Set the value of id_pergunta
     */
    public function setIdPergunta($id_pergunta): self
    {
        $this->id_pergunta = $id_pergunta;

        return $this;
    }

    /**
     * Get the value of questionario
     */
    public function getQuestionario(): Questionario
    {
        return $this->questionario;
    }

    /**
     * Set the value of questionario
     */
    public function setQuestionario(Questionario $questionario): self
    {
        $this->questionario = $questionario;

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

    // /**
    //  * Get the value of id_principio
    //  */
    // public function getIdPrincipio()
    // {
    //     return $this->id_principio;
    // }

    // /**
    //  * Set the value of id_principio
    //  */
    // public function setIdPrincipio($id_principio): self
    // {
    //     $this->id_principio = $id_principio;

    //     return $this;
    // }

    /**
     * Get the value of justificativa
     */
    public function getJustificativa()
    {
        return $this->justificativa;
    }

    /**
     * Set the value of justificativa
     */
    public function setJustificativa($justificativa): self
    {
        $this->justificativa = $justificativa;

        return $this;
    }
}