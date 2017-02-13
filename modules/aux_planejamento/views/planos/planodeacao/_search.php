<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanodeacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planodeacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'plan_codplano') ?>

    <?= $form->field($model, 'plan_descricao') ?>

    <?= $form->field($model, 'plan_codeixo') ?>

    <?= $form->field($model, 'plan_codsegmento') ?>

    <?= $form->field($model, 'plan_codtipoa') ?>

    <?php // echo $form->field($model, 'plan_codnivel') ?>

    <?php // echo $form->field($model, 'plan_cargahoraria') ?>

    <?php // echo $form->field($model, 'plan_sobre') ?>

    <?php // echo $form->field($model, 'plan_prerequisito') ?>

    <?php // echo $form->field($model, 'plan_perfTecnico') ?>

    <?php // echo $form->field($model, 'plan_codcolaborador') ?>

    <?php // echo $form->field($model, 'plan_data') ?>

    <?php // echo $form->field($model, 'plan_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
