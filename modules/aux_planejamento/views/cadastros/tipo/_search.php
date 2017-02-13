<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\TipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tip_codtipoa') ?>

    <?= $form->field($model, 'tip_descricao') ?>

    <?= $form->field($model, 'tip_sigla') ?>

    <?= $form->field($model, 'tip_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
