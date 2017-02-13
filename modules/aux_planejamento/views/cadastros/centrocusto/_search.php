<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\CentrocustoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centrocusto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cen_codcentrocusto') ?>

    <?= $form->field($model, 'cen_centrocusto') ?>

    <?= $form->field($model, 'cen_coddepartamento') ?>

    <?= $form->field($model, 'cen_codsituacao') ?>

    <?php // echo $form->field($model, 'cen_codunidade') ?>

    <?php // echo $form->field($model, 'cen_codsegmento') ?>

    <?php // echo $form->field($model, 'cen_codtipoacao') ?>

    <?php // echo $form->field($model, 'cen_nometipoacao') ?>

    <?php // echo $form->field($model, 'cen_codano') ?>

    <?php // echo $form->field($model, 'cen_centrocustoreduzido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
