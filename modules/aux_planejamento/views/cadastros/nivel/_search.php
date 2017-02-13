<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\NivelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nivel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'niv_codnivel') ?>

    <?= $form->field($model, 'niv_descricao') ?>

    <?= $form->field($model, 'niv_sigla') ?>

    <?= $form->field($model, 'niv_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
