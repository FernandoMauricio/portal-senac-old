<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\ClassificadosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classificados-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomeLista') ?>

    <?= $form->field($model, 'arquivoLista') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'edital_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
