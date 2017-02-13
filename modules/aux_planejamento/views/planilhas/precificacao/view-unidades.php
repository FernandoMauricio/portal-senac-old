<?php

use app\modules\aux_planejamento\models\planilhas\PrecificacaoUnidades;
use app\modules\aux_planejamento\models\base\Unidade;

?>

<div class="precificacao2-view">

 <div class="row">
     <p class="bg-info" style="padding: 10px; text-align: center;"><strong> PLANILHA DE CUSTO E FORMAÇÃO DE PREÇO DE VENDA <br>
     <span style="color: #F7941D;"><?php echo $model->planodeacao->plan_descricao; ?></strong></span>
     </p>
</div>

  <table class="table table-condensed table-hover">
    <thead>
      <tr>
        <th>Unidade</th>
        <th>Carga Horária</th>
        <th>Qnt Alunos</th>
        <th>Total Custo Direto</th>
        <th>Valor Total da Turma</th>
        <th>Valor Por Aluno</th>
        <th>Valor Hora/Aula</th>
      </tr>
    </thead>

    <tbody>
        <?php

            //realiza a soma do valor total da turma das unidades
            $query = (new \yii\db\Query())->from('db_apl2.precificacao_unidades')->where(['precificacao_id' => $model->planp_id]);
            $totalVendaTurma = $query->sum('uprec_vendaturma');

            //realiza a soma do valor por aluno
            $queryVendaAluno = (new \yii\db\Query())->from('db_apl2.precificacao_unidades')->where(['precificacao_id' => $model->planp_id]);
            $totalVendaAluno = $queryVendaAluno->sum('uprec_vendaaluno');

            //realiza a soma do valor por aluno
            $queryHoraAula = (new \yii\db\Query())->from('db_apl2.precificacao_unidades')->where(['precificacao_id' => $model->planp_id]);
            $totalHoraAula = $queryHoraAula->sum('uprec_horaaula');

            //Busca no banco o quantitativo de Precificação das unidades configuradas pelo Markup
            $sql = "SELECT * FROM precificacao_unidades WHERE precificacao_id = '".$model->planp_id."'";
            $qnt_unidades = PrecificacaoUnidades::findBySql($sql)->count();

            $MediaVendaTurma = $totalVendaTurma / $qnt_unidades;
            $MediaVendaAluno = $totalVendaAluno / $qnt_unidades;
            $MediaHoraAula   = $totalHoraAula   / $qnt_unidades;

            $query_ListagemPrecificacao = "SELECT * FROM precificacao_unidades WHERE precificacao_id = '".$model->planp_id."'";
            $modelsPrecificacaoUnidades = PrecificacaoUnidades::findBySql($query_ListagemPrecificacao)->all(); 
            foreach ($modelsPrecificacaoUnidades as $modelPrecificacaoUnidades) {
                
              $uprec_codunidade       = $modelPrecificacaoUnidades["uprec_codunidade"];
              $uprec_cargahoraria     = $modelPrecificacaoUnidades["uprec_cargahoraria"];
              $uprec_qntaluno         = $modelPrecificacaoUnidades["uprec_qntaluno"];
              $uprec_totalcustodireto = $modelPrecificacaoUnidades["uprec_totalcustodireto"];
              $uprec_vendaturma       = $modelPrecificacaoUnidades["uprec_vendaturma"];
              $uprec_vendaaluno       = $modelPrecificacaoUnidades["uprec_vendaaluno"];
              $uprec_horaaula         = $modelPrecificacaoUnidades["uprec_horaaula"];

            $query_Unidades = "SELECT * FROM unidade_uni WHERE uni_codunidade = '".$uprec_codunidade."' ";
            $modelsUnidades = Unidade::findBySql($query_Unidades)->all(); 
            foreach ($modelsUnidades as $modelUnidades) {
                
              $nomeUnidade       = $modelUnidades["uni_nomeabreviado"];

            }
        ?>
      <tr>
        <td><?php echo $nomeUnidade; ?></td>
        <td><?php echo $uprec_cargahoraria; ?></td>
        <td><?php echo $uprec_qntaluno; ?></td>
        <td><?php echo 'R$ ' . number_format($uprec_totalcustodireto, 2, ',', '.'); ?></td>
        <td><?php echo 'R$ ' . number_format($uprec_vendaturma, 2, ',', '.'); ?></td>
        <td><?php echo 'R$ ' . number_format($uprec_vendaaluno, 2, ',', '.'); ?></td>
        <td><?php echo 'R$ ' . number_format($uprec_horaaula, 2, ',', '.'); ?></td>
      </tr>
      <?php
        }
      ?>
    </tbody>

    <tfoot>
            <tr class="warning kv-edit-hidden" style="border-top: #dedede">
              <th>Média Total </th>
               <th colspan="1" style="color:red"><?php echo $uprec_cargahoraria; ?></th>
               <th colspan="1" style="color:red"><?php echo $uprec_qntaluno; ?></th>
               <th colspan="1" style="color:red"><?php echo 'R$ ' . number_format($uprec_totalcustodireto, 2, ',', '.'); ?></th>
               <th colspan="1" style="color:red"><?php echo 'R$ ' . number_format($MediaVendaTurma, 2, ',', '.'); ?></th>
               <th colspan="1" style="color:red"><?php echo 'R$ ' . number_format($MediaVendaAluno, 2, ',', '.'); ?></th>
               <th colspan="1" style="color:red"><?php echo 'R$ ' . number_format($MediaHoraAula, 2, ',', '.'); ?></th>
            </tr>
    </tfoot>

  </table>

</div>
