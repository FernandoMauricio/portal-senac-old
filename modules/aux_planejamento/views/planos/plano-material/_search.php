<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoMaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plano-material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'plama_codplama') ?>

    <?= $form->field($model, 'plama_codplano') ?>

    <?= $form->field($model, 'plama_codtiplama') ?>

    <?= $form->field($model, 'plama_codrepositorio') ?>

    <?= $form->field($model, 'plama_titulo') ?>

    <?php // echo $form->field($model, 'plama_valor') ?>

    <?php // echo $form->field($model, 'plama_arquivo') ?>

    <?php // echo $form->field($model, 'plama_tipomaterial') ?>

    <?php // echo $form->field($model, 'plama_observacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
