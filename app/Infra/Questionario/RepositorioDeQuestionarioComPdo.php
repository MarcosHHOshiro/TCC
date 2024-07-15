<?php

namespace App\Infra\Questionario;
use App\Dominio\Questionario\InterfaceRepositorioDeQuestionario;
use app\Dominio\Questionario\Questionario;
use DB\DataBase;

class RepositorioDeQuestionarioComPdo implements InterfaceRepositorioDeQuestionario
{

    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }
    
    public function cadastrar(Questionario $questionario): void
    {
        $this->db->setTable("tb_url");
        $idUrl = ($this->db)->insert([
            'id_url'    =>  $questionario->getUrl()->getIdUrl(),
            'titulo' =>  $questionario->getTitulo(),
            'descricao' =>  $questionario->getDescricao(),
            'id_usuario' =>  $questionario->getUsuario()->getIdUsuario(),
            'padrao' =>  $questionario->getPadrao(),
            'data_inicio' =>  $questionario->getDataInicio(),
            'data_fim' =>  $questionario->getDataFim(),
            'status' =>  $questionario->getStatus(),
            'id_profissao' =>  $questionario->getProfissao()->getIdProfissao(),
            'id_escolaridade' =>  $questionario->getEscolaridade()->getIdEscolaridade()
        ]);

        return;
    }

    public function buscarTodos(): array
    {
        
    }
}