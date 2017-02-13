<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\MarkupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="markup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mark_id') ?>

    <?= $form->field($model, 'mark_codunidade') ?>

    <?= $form->field($model, 'mark_ipca') ?>

    <?= $form->field($model, 'mark_reservatecnica') ?>

    <?= $form->field($model, 'mark_despesasede') ?>

    <?php // echo $form->field($model, 'mark_totalincidencias') ?>

    <?php // echo $form->field($model, 'mark_divisor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
