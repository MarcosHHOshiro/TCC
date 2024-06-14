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
}