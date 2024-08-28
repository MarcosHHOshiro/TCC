<?php

namespace App\Dominio\Questionario;

/** crudzin */
interface InterfaceRepositorioDeQuestionario
{
    public function cadastrar(Questionario $questionario): int;

}