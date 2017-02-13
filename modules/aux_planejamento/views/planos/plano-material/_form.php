<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plano-material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($planoMaterial, 'plama_codplano')->textInput(['maxlength' => true]) ?>

    <?= $form->field($planoMaterial, 'plama_codtiplama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($planoMaterial, 'plama_codrepositorio')->textInput() ?>

    <?= $form->field($planoMaterial, 'plama_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($planoMaterial, 'plama_valor')->textInput() ?>

    <?= $form->field($planoMaterial, 'plama_arquivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($planoMaterial, 'plama_tipomaterial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($planoMaterial, 'plama_observacao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($planoMaterial->isNewRecord ? 'Create' : 'Update', ['class' => $planoMaterial->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
