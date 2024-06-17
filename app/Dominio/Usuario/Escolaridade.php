<?php

namespace app\Dominio\Usuario;

class Escolaridade{
    private $id_escolaridade;
    private $nome_escolaridade;
    private $ativa;

    /**
     * Get the value of nome_escolaridade
     */
    public function getNomeEscolaridade() {
        return $this->nome_escolaridade;
    }

    /**
     * Set the value of nome_escolaridade
     */
    public function setNomeEscolaridade($nome_escolaridade): self {
        $this->nome_escolaridade = $nome_escolaridade;
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
     * Get the value of id_escolaridade
     */
    public function getIdEscolaridade() {
        return $this->id_escolaridade;
    }

    /**
     * Set the value of id_escolaridade
     */
    public function setIdEscolaridade($id_escolaridade): self {
        $this->id_escolaridade = $id_escolaridade;
        return $this;
    }
}