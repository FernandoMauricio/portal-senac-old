<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\MaterialconsumoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialconsumo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'matcon_codMXM') ?>

    <?= $form->field($model, 'matcon_descricao') ?>

    <?= $form->field($model, 'matcon_tipo') ?>

    <?= $form->field($model, 'matcon_valor') ?>

    <?= $form->field($model, 'matcon_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
