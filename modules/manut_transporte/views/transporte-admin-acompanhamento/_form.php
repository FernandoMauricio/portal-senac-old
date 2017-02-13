<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use \kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Transporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transporte-form">

    <?php $form = ActiveForm::begin(); ?>


<div class="row">
  <div class="col-md-2">

  <?= $form->field($model, 'tipo_transporte_label')->textInput(['value'=> $model->tipoSolic->descricao,'readonly'=>true]) ?>

  </div>

  <div class="col-md-3">

  <?= $form->field($model, 'tipo_carga_label')->textInput(['value'=> $model->tipoCarga->descricao,'readonly'=>true]) ?>


  </div>


  <div class="col-md-3">

  <?= $form->field($model, 'bairro_label')->textInput(['value'=> $model->bairro->descricao,'readonly'=>true]) ?>

  </div>


  <div class="col-md-4">

  <?= $form->field($model, 'situacao_label')->textInput(['value'=> $model->situacao->nome,'readonly'=>true]) ?>

  </div>

</div>


    <?= $form->field($model, 'local')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'descricao_transporte')->textarea(['rows' => 6,'readonly'=>true]) ?>


<div class="row">
  <div class="col-md-3">

    <?php
            echo $form->field($model, 'data_prevista')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'disabled' => true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true,
                    
                ]
            ]
        ]);
    ?>    

  </div>

  <div class="col-md-3">
      
          <?php
            echo $form->field($model, 'hora_prevista')->widget(TimePicker::classname(), [
                'options' => ['readonly' => true,'disabled' => true,],
                'pluginOptions' => [
                'autoclose' => true,
                'showSeconds' => false,
                'showMeridian' => false,
            ]
        ]);
    ?>

  </div>

  <div class="col-md-3">

    <?php
            echo $form->field($model, 'data_confirmacao')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true,
                    
                ]
            ]
        ]);
    ?>    

  </div>

  <div class="col-md-3">
      
          <?php
            echo $form->field($model, 'hora_confirmacao')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                'autoclose' => true,
                'showSeconds' => false,
                'showMeridian' => false,
                'defaultTime' => false,
            ]
        ]);
    ?>

  </div>

</div>


        <?php
                    $data_motoristas = ArrayHelper::map($motoristas, 'id', 'descricao');
                    echo $form->field($model, 'motorista_id')->widget(Select2::classname(), [
                        'data' => $data_motoristas,
                        'options' => ['placeholder' => 'Selecione um motorista...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);                    
         ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar Informações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


