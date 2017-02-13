<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\MaterialalunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialaluno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'matalu_cod') ?>

    <?= $form->field($model, 'matalu_descricao') ?>

    <?= $form->field($model, 'matalu_unidade') ?>

    <?= $form->field($model, 'matalu_valor') ?>

    <?= $form->field($model, 'matalu_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
