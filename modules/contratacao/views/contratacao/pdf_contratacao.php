<?php
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\modules\contratacao\models\Recrutamento;
use app\modules\contratacao\models\Sistemas;

?>

<body>

<div class="panel panel-primary">

      <div class="panel-body">
          <div class="row">
                              <!--    INFORMÇÕES DO CANDIDATO    -->
  <table class="table table-condensed table-hover" style="margin-top: -15px">
    <thead>
    <tr class="default">
      <th colspan="4" style="text-align: center;"><img src="../web/css/img/logo.png" width="80" height="35" alt="logo" /></th>
      <th colspan="9" style="text-align: center; vertical-align:inherit"> DETALHES DA SOLICITAÇÃO DE CONTRATAÇÃO DE PESSOAL</th>
    </tr>
    </thead>

  </table>

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="13">Informações</th></tr>
    </thead>

<tbody>
    <tr>
        <td colspan="2"><strong>Código: </strong><?php echo $model->id; ?></td>
        <td colspan="4"><strong>Solicitante: </strong><?php echo $model->colaborador; ?></td> 
        <td colspan="6"><strong>Unidade: </strong> <?php echo $model->unidade; ?></td>
    </tr> 

    <tr>
        <td colspan="2"><strong>Qnt a ser contratada: </strong><?php echo $model->quant_pessoa; ?></td>
        <td colspan="3"><strong>Substituição: </strong><?php echo $model->substituicao ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="7"><strong>Servidor a ser substituído: </strong><?php echo $model->nome_substituicao; ?></td>
        <td></td>
    </tr> 
    <tr>
        <td colspan="12"><strong>Motivo da contratação: </strong><?php echo $model->motivo; ?></td>
        <td></td>
    </tr> 

    <tr>
        <td colspan="6"><strong>Período Indeterminado: </strong><?php echo $model->periodo ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="6"><strong>Período em meses: </strong><?php echo $model->tempo_periodo; ?></td>
        <td></td>
    </tr> 

    <tr>
        <td colspan="5"><strong>Necessidade de aumento: </strong><?php echo $model->aumento_quadro ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="7"><strong>Justificativa do aumento: </strong><?php echo $model->obs_aumento; ?></td>
        <td></td>
    </tr> 

    <tr>
        <td colspan="5"><strong>Previsão de ingresso: </strong><?php echo $model->data_ingresso; ?></td>
        <td colspan="5"><strong>Recrutamento de pessoa com deficiência: </strong><?php echo $model->deficiencia ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="2"><strong>Observação: </strong><?php echo $model->obs_deficiencia; ?></td>
    </tr> 

    <tr>
        
        <td colspan="12"><strong>Motivo da contratação: </strong><?php echo $model->motivo; ?></td>
        <td></td>
    </tr> 
</tbody>
 </table>


  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="13">Identificação do Perfil</th></tr>
    </thead>

<tbody>

    <tr>
        <td colspan="4"><strong>Ensino Fundamental: </strong>(<?php if($model->fundamental_comp == 1) echo "X"; ?>) Completo (<?php if($model->fundamental_inc == 1) echo "X"; ?>) Incompleto</td>
        <td colspan="4"><strong>Ensino Médio: </strong>(<?php if($model->medio_comp == 1) echo "X"; ?>) Completo (<?php if($model->medio_inc == 1) echo "X"; ?>) Incompleto</td> 
        <td colspan="4"></td>
    </tr> 

    <tr>
        <td colspan="4"><strong>Ensino Técnico: </strong>(<?php if($model->tecnico_comp == 1) echo "X"; ?>) Completo (<?php if($model->tecnico_inc == 1) echo "X"; ?>) Incompleto</td>
        <td colspan="4"><strong>Área: </strong><?php echo $model->tecnico_area; ?></td> 
        <td colspan="4"></td>
    </tr> 

    <tr>
        <td colspan="4"><strong>Ensino Superior: </strong>(<?php if($model->superior_comp == 1) echo "X"; ?>) Completo (<?php if($model->superior_inc == 1) echo "X"; ?>) Incompleto</td>
        <td colspan="4"><strong>Área: </strong><?php echo $model->superior_area; ?></td> 
        <td colspan="4"></td>
    </tr> 

     <tr>
        <td colspan="4"><strong>Pós-Graduação: </strong>(<?php if($model->pos_comp == 1) echo "X"; ?>) Completo (<?php if($model->pos_inc == 1) echo "X"; ?>) Incompleto</td>
        <td colspan="4"><strong>Área: </strong><?php echo $model->pos_area; ?></td> 
        <td colspan="4"></td>
    </tr>

    </tbody>    
 </table>

  <table class="table table-condensed table-hover">

  <tbody>
     <tr>
        <td colspan="12"><strong>Domínio de alguma atividade: </strong><?php echo $model->dominio_atividade; ?></td>
    </tr>      
     <tr>
        <td colspan="12"><strong>Domínio de Informática: </strong>(<?php if($model->windows == 1) echo "X"; ?>)Windows&nbsp;(<?php if($model->word == 1) echo "X"; ?>)Word&nbsp;(<?php if($model->excel == 1) echo "X"; ?>)Excel&nbsp;(<?php if($model->internet == 1) echo "X"; ?>)Internet</td>
    </tr> 
     <tr>
        <td colspan="8"><strong>Experiência comprovada: </strong><?php echo $model->experiencia ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="1"><strong>Área: </strong><?php echo $model->experiencia_tempo; ?></td> 
        <td colspan="3"><strong>Em qual atividade: </strong><?php echo $model->experiencia_atividade; ?></td> 
    </tr>

     <tr>
        <td colspan="5"><strong>Disponibilidade de Horário: </strong><?php echo $model->jornada_horas ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
        <td colspan="7"><strong>Observações: </strong><?php echo $model->jornada_obs; ?></td> 
    </tr>

     <tr>
        <td colspan="12"><strong>Principais atividades a serem desenvolvidas: </strong><?php echo $model->principais_atividades; ?></td> 
    </tr>

     <tr>
        <td colspan="12"><strong>Métodos de seleção indicados: </strong>(<?php if($model->selec_curriculo == 1) echo "X"; ?>) Análise de Currículo
    (<?php if($model->selec_dinamica == 1) echo "X"; ?>) Dinâmica de Grupo
    (<?php if($model->selec_prova == 1) echo "X"; ?>) Provas gerais ou técnicas
    (<?php if($model->selec_entrevista == 1) echo "X"; ?>) Entrevista
    (<?php if($model->selec_teste == 1) echo "X"; ?>) Testes Psicológicos</td> 
    </tr>

     <tr>
        <td colspan="12"><strong>Sistemas para cadastro de colaborador: </strong>

               <?php

  $query_sistemas = "SELECT descricao FROM sistemas, sistemas_contratacao WHERE contratacao_id = '".$model->id."' AND sistema_id = idsistema";
  $sistema = Sistemas::findBySql($query_sistemas)->all(); 
  foreach ($sistema as $sistemas) {

   $Sistemas = $sistemas["descricao"];

    echo $Sistemas.' / ' ;
  }

    ?>

      </td> 
    </tr>


     <tr>
        <td colspan="12" align="center"><strong>Assinado eletrônicamente por: </strong><br />
        <?php echo $model->colaborador; ?><br />
        <?php echo $model->cargo; ?><br />
        <?php echo date('d/m/Y', strtotime($model->data_solicitacao)); ?> às <?php echo date('H:i:s', strtotime($model->hora_solicitacao)); ?>&nbsp;&nbsp;&nbsp;<br /></p></td>
    </tr>

     <tr>
        <td colspan="12" align="center"><strong>Obs.: Este instrumento atende as exigências contidas na Resolução nº 1.018/2015 do CN do Senac.</strong></td> 
    </tr>

</tbody> 

</table>

      </div>
   </div>
 </div>

</body>
</html>