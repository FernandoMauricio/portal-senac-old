<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\VestibularSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vestibular-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idVest') ?>

    <?= $form->field($model, 'descVest') ?>

    <?= $form->field($model, 'dataAbertura') ?>

    <?= $form->field($model, 'dataEncerramento') ?>

    <?= $form->field($model, 'curso') ?>

    <?php // echo $form->field($model, 'vagas') ?>

    <?php // echo $form->field($model, 'turno') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
