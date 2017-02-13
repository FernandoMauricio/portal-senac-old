<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>

<div class="panel panel-primary">
    <div class="panel-body">
          <div class="row">
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 1: Informações do Curso</th></tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:11px;" colspan="1"><strong>Código: </strong> <?php echo $model->planp_id; ?></td>
            <td style="font-size:11px;" colspan="1"><strong>Ano: </strong> <?php echo $model->planp_ano; ?></td>
            <td style="font-size:11px;" colspan="5"><strong>Unidade: </strong> <?php echo $model->unidade->uni_nomeabreviado; ?></td>
            <td style="font-size:11px;" colspan="5"><strong>Plano de Ação: </strong> <?php echo $model->planodeacao->plan_descricao; ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="2"><strong>Carga Horária: </strong><br> <?php echo $model->planp_cargahoraria; ?></td>
            <td style="font-size:11px;" colspan="10"><strong>Qnt Alunos: </strong><br> <?php echo $model->planp_qntaluno; ?></td>
        </tr>
    </tbody>
 </table>

 <br>

   <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 2: Cálculos de Custos Diretos</th></tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Nível Docente: </strong> <?php echo $model->despesasdocente->doce_descricao; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Total Horas Docente: </strong><br> <?php echo $model->planp_totalhorasdocente; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Hora/Aula S. Pedagógico (s/produtividade): </strong><br> <?php echo $model->planp_servpedagogico; ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Valor Hora/Aula: </strong><br> <?php echo 'R$ ' . number_format($model->planp_valorhoraaula, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Valor Hora/Aula Planejamento: </strong> <br> <?php  echo 'R$ ' . number_format($model->planp_horaaulaplanejamento, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Custo de Mão de Obra Direta: </strong> <br> <?php echo 'R$ ' . number_format( $model->planp_totalcustodocente, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="3"><strong>1/12 de 13º: </strong><br> <?php echo 'R$ ' . number_format($model->planp_decimo, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>1/12 de Férias: </strong><br><?php  echo 'R$ ' . number_format($model->planp_ferias, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>1/12 de 1/3 de férias: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_tercoferias, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Total de Salários: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalsalario, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>(%) Encargos s/13º, férias e salários: </strong><br> <?php echo number_format($model->planp_encargos, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Total de Encargos: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalencargos, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Total de Salários + Encargos:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalsalarioencargo, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="3"><strong>Diárias: </strong><br> <?php echo 'R$ ' . number_format($model->planp_diarias, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Passagens: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_passagens, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Serv. Terceiros (PF): </strong><br> <?php echo 'R$ ' . number_format( $model->planp_pessoafisica, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Serv. Terceiros (PJ): </strong><br> <?php echo 'R$ ' . number_format( $model->planp_pessoajuridica, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="3"><strong>Mat. Didático (Apostila/plano A): </strong><br> <?php echo 'R$ ' .  number_format($model->planp_PJApostila, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Mat. Didático (Livros/plano A): </strong><br> <?php echo 'R$ ' .  number_format($model->planp_custosmateriais, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Material Consumo: </strong><br> <?php echo 'R$ ' .  number_format($model->planp_custosconsumo, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Total de Custo Direto: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalcustodireto, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="12"><strong>Valor Hora/Aula de Custo Direto: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalhoraaulacustodireto, 2, ',', '.'); ?></td>
        </tr>
    </tbody>
   </table>

 <br>

   <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 3: Cálculos de Custos Indiretos</th></tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:11px;" colspan="3"><strong>Custos Indiretos(%): </strong><br> <?php echo number_format($model->planp_custosindiretos, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="3"><strong>IPCA/Mês(%): </strong><br> <?php echo number_format($model->planp_ipca, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Rerserva Técnica(%): </strong><br> <?php echo number_format($model->planp_reservatecnica, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Despesa Sede ADM 2016(%): </strong><br> <?php echo number_format($model->planp_despesadm, 2, ',', '.') . '%'; ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Total Incidências(%): </strong><br> <?php echo number_format($model->planp_totalincidencias, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Total Custo Indireto: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalcustoindireto, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Despesa Total: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_despesatotal, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Mark-Up Divisor 100-X/100: </strong><br> <?php echo number_format($model->planp_markdivisor, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Mark-Up Multiplicador 100/Markup: </strong><br> <?php echo number_format($model->planp_markmultiplicador, 2, ',', '.') . '%'; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Preço de Venda Total da Turma: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_vendaturma, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="3"><strong>Preço de Venda Total por Aluno: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_vendaaluno, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Retorno com Preço de Venda: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_retorno, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>Valor Hora/Aula por Aluno: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_horaaulaaluno, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="3"><strong>% de Retorno: </strong><br> <?php echo number_format($model->planp_porcentretorno, 2, ',', '.') . '%'; ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Preço Sugerido: </strong><br>  <?php echo 'R$ ' . number_format( $model->planp_precosugerido, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Retorno com preço sugerido: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_retornoprecosugerido, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Numero minimo de alunos por turma: </strong><br> <?php echo $model->planp_minimoaluno; ?></td>
        </tr>
        <tr>
            <td style="font-size:11px;" colspan="4"><strong>Quantidade de Parcelas: </strong><br> <?php echo $model->planp_parcelas; ?></td>
            <td style="font-size:11px;" colspan="4"><strong>Valor das Parcelas: </strong><br> <?php echo 'R$ ' . number_format( $model->planp_valorparcelas, 2, ',', '.'); ?></td>
            <td style="font-size:11px;" colspan="4"></td>
        </tr>
    </tbody>
   </table>

 <br>

   <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 4: Auditoria</th></tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:11px;" colspan="6"><strong>Cadastrado por: </strong><br> <?php echo $model->colaborador->usuario->usu_nomeusuario ?></td>
            <td style="font-size:11px;" colspan="6"><strong>Data de Cadastro: </strong><br> <?php echo date('d/m/Y', strtotime($model->planp_data)) ?></td>
        </tr>
    </tbody>
   </table>

        </div>
    </div>
</div>

   <br><br><br><br><br>

<div class="panel panel-primary">
    <div class="panel-body">
          <div class="row">

            <div class="panel-body">

               <?= $this->render('view-unidades', [
                                    'model' => $model,
                        ]) ?>

            </div>
        </div>
    </div>
</div>
