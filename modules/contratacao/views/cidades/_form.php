<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Cargo' : 'Atualizar Cidade', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
