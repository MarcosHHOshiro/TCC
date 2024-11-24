<?php

namespace App\Aplicacao\Relatorios;

use App\Infra\Questionario\RepositorioDeQuestionarioComPdo;
use PDO;

class ConsultaResultadosQUestionariosPelasPerguntas
{
    public function executa($request, $idRelatorio)
    {
        $repositorioGeral = new RepositorioDeQuestionarioComPdo;

        $dados = $repositorioGeral->selectQueryCompleta("SELECT tb_perguntas.id_pergunta, 
        count(tb_resposta.id_resposta) as quantidade, resposta, tb_perguntas.descricao as pergunta
            from tb_questionario
            inner join tb_perguntas on tb_questionario.id_questionario = tb_perguntas.id_questionario
            inner join tb_resposta on tb_perguntas.id_pergunta = tb_resposta.id_pergunta
            where tb_questionario.id_questionario = ?
            group by tb_perguntas.id_pergunta, resposta
            order by tb_perguntas.id_pergunta", [$idRelatorio])->fetchAll(PDO::FETCH_ASSOC);
        // echo"<pre>";
        // print_r($dados);exit;
        $total_respostas = array_sum(array_column($dados, 'quantidade'));

        if(empty($dados)){
            throw new \Exception("Sem cadastro para essa consulta!");
        }

        // Cria um array para somar o total de cada resposta
        $resposta_counts = [];

        foreach ($dados as $item) {
            $resposta = $item['resposta'];
            if (!isset($resposta_counts[$resposta])) {
                $resposta_counts[$resposta] = 0;
            }
            $resposta_counts[$resposta] += $item['quantidade'];
        }

        // Calcula as porcentagens gerais e monta o array 'geral'
        $geral = [];
        foreach ($resposta_counts as $resposta => $count) {
            $geral[] = [
                'resposta' => $resposta,
                'quantidade' => $count,
                'percentual_geral' => round(($count / $total_respostas) * 100, 2),
            ];
        }

        // Agrupa por id_pergunta (estrutura dados$dados)
        $resultado = [];

        foreach ($dados as $item) {
            $id_pergunta = $item['id_pergunta'];
            $resposta_data = [
                'resposta' => $item['resposta'],
                'quantidade' => $item['quantidade'],
            ];

            $encontrou = false;
            foreach ($resultado as &$pergunta) {
                if ($pergunta['id_pergunta'] === $id_pergunta) {
                    $pergunta['respostas'][] = $resposta_data;
                    $encontrou = true;
                    break;
                }
            }
            if (!$encontrou) {
                $resultado[] = [
                    'id_pergunta' => $id_pergunta,
                    'pergunta' => $item['pergunta'],
                    'respostas' => [$resposta_data],
                ];
            }
        }

        // Array final com 'geral' separado do array 'perguntas'
        $array_final = [
            'perguntas' => $resultado,
            'geral' => $geral,
        ];

        return $array_final;
    }
}