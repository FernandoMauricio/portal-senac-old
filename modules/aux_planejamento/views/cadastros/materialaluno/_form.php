<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialaluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialaluno-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">

    <div class="col-md-8">
    <?= $form->field($model, 'matalu_descricao')->textInput(['maxlength' => true]) ?>
    </div>

	<div class="col-md-2">
        <?php
                    $data_tipounidade = ArrayHelper::map($tipounidade, 'tipuni_descricao', 'tipuni_descricao');
                    echo $form->field($model, 'matalu_unidade')->widget(Select2::classname(), [
                            'data' =>  $data_tipounidade,
                            'options' => ['placeholder' => 'Selecione a unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>

	<div class="col-md-2">
    <?= $form->field($model, 'matalu_valor')->widget(MaskMoney::classname());  ?>
    </div>
</div>

    <?= $form->field($model, 'matalu_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
