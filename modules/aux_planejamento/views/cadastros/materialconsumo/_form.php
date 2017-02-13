<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialconsumo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materialconsumo-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">

    <div class="col-md-2">
    <?= $form->field($model, 'matcon_codMXM')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'matcon_descricao')->textInput(['maxlength' => true]) ?>
    </div>

	<div class="col-md-2">
        <?php
                    $data_tipounidade = ArrayHelper::map($tipounidade, 'tipuni_descricao', 'tipuni_descricao');
                    echo $form->field($model, 'matcon_tipo')->widget(Select2::classname(), [
                            'data' =>  $data_tipounidade,
                            'options' => ['placeholder' => 'Selecione a unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>

	<div class="col-md-2">
    <?= $form->field($model, 'matcon_valor')->widget(MaskMoney::classname());  ?>
    </div>
</div>
    <?= $form->field($model, 'matcon_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
