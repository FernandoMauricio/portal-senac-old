<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\DespesasdocenteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despesasdocente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'doce_id') ?>

    <?= $form->field($model, 'doce_descricao') ?>

    <?= $form->field($model, 'doce_valor') ?>

    <?= $form->field($model, 'doce_dsr') ?>

    <?= $form->field($model, 'doce_planejamento') ?>

    <?php // echo $form->field($model, 'doce_produtividade') ?>

    <?php // echo $form->field($model, 'doce_valorhoraaula') ?>

    <?php // echo $form->field($model, 'doce_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
