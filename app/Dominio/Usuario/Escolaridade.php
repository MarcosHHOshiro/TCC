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
}