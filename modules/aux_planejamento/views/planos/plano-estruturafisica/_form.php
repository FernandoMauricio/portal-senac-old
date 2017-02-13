<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoEstruturafisica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plano-estruturafisica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'planestr_cod')->textInput() ?>

    <?= $form->field($model, 'planodeacao_cod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estruturafisica_cod')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
