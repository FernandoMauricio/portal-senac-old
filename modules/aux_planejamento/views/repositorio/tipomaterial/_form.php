<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\repositorio\Tipomaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipomaterial-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="row">

		    <div class="col-md-6">
		    <?= $form->field($model, 'tip_descricao')->textInput(['maxlength' => true]) ?>
		    </div>

			<div class="col-md-6">
		        <?php
		                    $data_elemento = ArrayHelper::map($elementodespesa, 'eled_despesa', 'eled_despesa');
		                    echo $form->field($model, 'tip_elementodespesa_id')->widget(Select2::classname(), [
		                            'data' =>  $data_elemento,
		                            'options' => ['placeholder' => 'Selecione o elemento de despesa...'],
		                            'pluginOptions' => [
		                                    'allowClear' => true
		                                ],
		                            ]);
		        ?>
		    </div>
		    
		</div>

    <?= $form->field($model, 'tip_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
