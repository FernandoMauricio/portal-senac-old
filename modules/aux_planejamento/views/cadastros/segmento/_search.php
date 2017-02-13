<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\SegmentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="segmento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'seg_codsegmento') ?>

    <?= $form->field($model, 'seg_descricao') ?>

    <?= $form->field($model, 'seg_codeixo') ?>

    <?= $form->field($model, 'seg_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
