<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\RepositorioMateriaisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repositorio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rep_codrepositorio') ?>

    <?= $form->field($model, 'rep_titulo') ?>

    <?= $form->field($model, 'rep_categoria') ?>

    <?= $form->field($model, 'rep_tipo') ?>

    <?= $form->field($model, 'rep_editora') ?>

    <?php // echo $form->field($model, 'rep_valor') ?>

    <?php // echo $form->field($model, 'rep_sobre') ?>

    <?php // echo $form->field($model, 'rep_arquivo') ?>

    <?php // echo $form->field($model, 'rep_codunidade') ?>

    <?php // echo $form->field($model, 'rep_codcolaborador') ?>

    <?php // echo $form->field($model, 'rep_data') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
