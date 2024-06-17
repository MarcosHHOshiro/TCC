<?php

namespace app\Dominio\Usuario;

class Profissao{
    private $id_profissao;
    private $nome_profissao;
    private $ativa;

    /**
     * Get the value of id_profissao
     */
    public function getIdProfissao() {
        return $this->id_profissao;
    }

    /**
     * Set the value of id_profissao
     */
    public function setIdProfissao($id_profissao): self {
        $this->id_profissao = $id_profissao;
        return $this;
    }

    /**
     * Get the value of ativa
     */
    public function getAtiva() {
        return $this->ativa;
    }

    /**
     * Set the value of ativa
     */
    public function setAtiva($ativa): self {
        $this->ativa = $ativa;
        return $this;
    }

    /**
     * Get the value of nome_profissao
     */
    public function getNomeProfissao() {
        return $this->nome_profissao;
    }

    /**
     * Set the value of nome_profissao
     */
    public function setNomeProfissao($nome_profissao): self {
        $this->nome_profissao = $nome_profissao;
        return $this;
    }
}