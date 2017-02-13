<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\modeloa\ModeloASearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modelo-a-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'moda_codmodelo') ?>

    <?= $form->field($model, 'moda_codano') ?>

    <?= $form->field($model, 'moda_centrocusto') ?>

    <?= $form->field($model, 'moda_centrocustoreduzido') ?>

    <?= $form->field($model, 'moda_nomecentrocusto') ?>

    <?php // echo $form->field($model, 'moda_codunidade') ?>

    <?php // echo $form->field($model, 'moda_nomeunidade') ?>

    <?php // echo $form->field($model, 'moda_codcolaborador') ?>

    <?php // echo $form->field($model, 'moda_codusuario') ?>

    <?php // echo $form->field($model, 'moda_nomeusuario') ?>

    <?php // echo $form->field($model, 'moda_codsituacao') ?>

    <?php // echo $form->field($model, 'moda_codentrada') ?>

    <?php // echo $form->field($model, 'moda_codsegmento') ?>

    <?php // echo $form->field($model, 'moda_codtipoacao') ?>

    <?php // echo $form->field($model, 'moda_descriminacaoprojeto') ?>

    <?php // echo $form->field($model, 'moda_identificacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
