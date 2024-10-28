<?php

namespace App\Aplicacao\Questionario\RespostaQuestionarioPeloAvaliador;


enum EnumQuestionario: int {  
    case RUIM = 1;
    case REGULAR = 2;
    case BOM = 3;
    case MUITO_BOM = 4;
    case OTIMO = 5;

}
