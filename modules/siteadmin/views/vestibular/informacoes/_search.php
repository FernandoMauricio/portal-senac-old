<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\InformacoesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacoes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomeInfo') ?>

    <?= $form->field($model, 'arquivoInfo') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'vestibular_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
