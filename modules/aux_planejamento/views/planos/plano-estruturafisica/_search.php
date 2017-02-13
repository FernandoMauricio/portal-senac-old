<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoEstruturafisicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plano-estruturafisica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'planestr_cod') ?>

    <?= $form->field($model, 'planodeacao_cod') ?>

    <?= $form->field($model, 'estruturafisica_cod') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'tipo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
