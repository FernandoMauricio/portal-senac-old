<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Despesasdocente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despesasdocente-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-5">
    <?= $form->field($model, 'doce_descricao')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'doce_encargos')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'doce_valor')->widget(MaskMoney::classname());  ?>
    </div>

    <div class="col-md-3">
    <?= $form->field($model, 'doce_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>
    </div>

</div>


    <?= $form->field($model, 'calculos')->radioList(['1' => 'Sim', '0' => 'Não']) ?>


</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
