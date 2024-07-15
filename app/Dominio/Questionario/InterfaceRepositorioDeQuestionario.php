<?php

namespace App\Dominio\Questionario;

/** crudzin */
interface InterfaceRepositorioDeQuestionario
{
    public function cadastrar(Questionario $questionario): void;

    /** @return Questionario[] */
    public function buscarTodos(): array;
}