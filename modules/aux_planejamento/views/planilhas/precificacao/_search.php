<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\PrecificacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="precificacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'planp_id') ?>

    <?= $form->field($model, 'planp_codunidade') ?>

    <?= $form->field($model, 'planp_planodeacao') ?>

    <?= $form->field($model, 'planp_cargahoraria') ?>

    <?= $form->field($model, 'planp_qntaluno') ?>

    <?php // echo $form->field($model, 'planp_totalhorasdocente') ?>

    <?php // echo $form->field($model, 'planp_docente') ?>

    <?php // echo $form->field($model, 'planp_valorhoraaula') ?>

    <?php // echo $form->field($model, 'planp_servpedagogico') ?>

    <?php // echo $form->field($model, 'planp_horaaulaplanejamento') ?>

    <?php // echo $form->field($model, 'planp_totalcustodocente') ?>

    <?php // echo $form->field($model, 'planp_decimo') ?>

    <?php // echo $form->field($model, 'planp_ferias') ?>

    <?php // echo $form->field($model, 'planp_tercoferias') ?>

    <?php // echo $form->field($model, 'planp_totalsalario') ?>

    <?php // echo $form->field($model, 'planp_encargos') ?>

    <?php // echo $form->field($model, 'planp_totalencargos') ?>

    <?php // echo $form->field($model, 'planp_totalsalarioencargo') ?>

    <?php // echo $form->field($model, 'planp_custosmateriais') ?>

    <?php // echo $form->field($model, 'planp_diarias') ?>

    <?php // echo $form->field($model, 'planp_passagens') ?>

    <?php // echo $form->field($model, 'planp_pessoafisica') ?>

    <?php // echo $form->field($model, 'planp_pessoajuridica') ?>

    <?php // echo $form->field($model, 'planp_totalcustodireto') ?>

    <?php // echo $form->field($model, 'planp_totalhoraaulacustodireto') ?>

    <?php // echo $form->field($model, 'planp_custosindiretos') ?>

    <?php // echo $form->field($model, 'planp_ipca') ?>

    <?php // echo $form->field($model, 'planp_reservatecnica') ?>

    <?php // echo $form->field($model, 'planp_despesadm') ?>

    <?php // echo $form->field($model, 'planp_totalincidencias') ?>

    <?php // echo $form->field($model, 'planp_totalcustoindireto') ?>

    <?php // echo $form->field($model, 'planp_despesatotal') ?>

    <?php // echo $form->field($model, 'planp_markdivisor') ?>

    <?php // echo $form->field($model, 'planp_markmultiplicador') ?>

    <?php // echo $form->field($model, 'planp_vendaturma') ?>

    <?php // echo $form->field($model, 'planp_vendaaluno') ?>

    <?php // echo $form->field($model, 'planp_horaaulaaluno') ?>

    <?php // echo $form->field($model, 'planp_retorno') ?>

    <?php // echo $form->field($model, 'planp_porcentretorno') ?>

    <?php // echo $form->field($model, 'planp_precosugerido') ?>

    <?php // echo $form->field($model, 'planp_retornoprecosugerido') ?>

    <?php // echo $form->field($model, 'planp_minimoaluno') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
