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

  <?= $form->field($model, 'tipo_transporte')->textInput(['value'=> $model->tipoSolic->descricao,'readonly'=>true]) ?>

  </div>

  <div class="col-md-4">

        <?php
                    $data_tipocarga = ArrayHelper::map($tipoCarga, 'idtipo_carga', 'descricao');
                    echo $form->field($model, 'tipocarga_id')->widget(Select2::classname(), [
                            'data' =>  $data_tipocarga,
                            'options' => ['placeholder' => 'Selecione o tipo de carga...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>


  </div>


  <div class="col-md-5">

        <?php
                    $data_bairros = ArrayHelper::map($bairros, 'idbairro', 'descricao');
                    echo $form->field($model, 'bairro_id')->widget(Select2::classname(), [
                            'data' =>  $data_bairros,
                            'options' => ['placeholder' => 'Selecione o bairro...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>

  </div>



</div>


    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_transporte')->textarea(['rows' => 6]) ?>


<div class="row">
  <div class="col-md-3">

    <?php
            echo $form->field($model, 'data_prevista')->widget(DateControl::classname(), [
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
            echo $form->field($model, 'hora_prevista')->widget(TimePicker::classname(), [
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


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Solicitação de Transporte' : 'Atualizar Informações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


