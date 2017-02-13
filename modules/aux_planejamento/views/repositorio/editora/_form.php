<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Editora */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="editora-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'edi_descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edi_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
