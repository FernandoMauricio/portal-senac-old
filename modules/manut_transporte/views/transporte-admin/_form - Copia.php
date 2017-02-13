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



         <?php
             echo Form::widget([
                 'model'=>$model,
                 'form'=>$form,
                 'columns'=>10,
                 'attributes'=>[
                         'tipo_transporte'=>['staticValue' => 'Transporte','type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]], 
                         'tipocarga_id'=>['staticValue' => $model->tipoCarga->descricao,'type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]],  
                         'bairro_id'=>['staticValue' =>$model->bairro->descricao ,'type'=>Form::INPUT_STATIC,'columnOptions'=>['colspan'=>2]],  
                         'data_solicitacao'=>['type'=>Form::INPUT_STATIC,'options'=>['inline'=>true,'readonly'=>true],'columnOptions'=>['colspan'=>2]],  
                         'situacao_id'=>['staticValue' =>$model->situacao->nome ,'type'=>Form::INPUT_STATIC,'options'=>['inline'=>true,'readonly'=>true],'columnOptions'=>['colspan'=>2]],  
                             ],
             ]);
         ?>


<?= $form->field($model, 'local')->textInput(['maxlength' => true, 'readonly' => true]) ?>



    <?= $form->field($model, 'descricao_transporte')->textarea(['rows' => 6,'readonly'=>true]) ?>


<div class="row">
    <div class="col-sm-6">
    <?php
            echo $form->field($model, 'data_confirmacao')->widget(DateControl::classname(), [
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

<?php


    echo $form->field($model, 'hora_confirmacao')->widget(TimePicker::classname(), [
        'options' => ['readonly' => true,'disabled' => true,],
        'pluginOptions' => [
        'autoclose' => true,
        'showSeconds' => false,
        'showMeridian' => false,
    ]
]);

?>

    </div>
    <div class="col-sm-6">
        <!-- embed your image frame -->
    </div>
</div>



         <?php
             echo Form::widget([
                 'model'=>$model,
                 'form'=>$form,
                 'columns'=>12,
                 'attributes'=>[
                 'data_prevista'=>['type'=>Form::INPUT_WIDGET, 'options' => ['pluginOptions' => ['format' => 'dd/mm/yyyy']], 'widgetClass'=>'\kartik\widgets\DatePicker', 'columnOptions'=>['colspan'=>4]],
                       // 'data_prevista'=>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2]], 
                        'hora_prevista'=>['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2]], 
                             ],
             ]);
         ?>


    <?php

        //     echo $form->field($model, 'data_confirmacao')->widget(DateControl::classname(), [
        //     'type'=>DateControl::FORMAT_DATE,
        //     'ajaxConversion'=>true,
        //     'disabled' => true,
        //     'options' => [
        //         'pluginOptions' => [
        //             'autoclose' => true,
                    
        //         ]
        //     ]
        // ]);

    ?>

    <?php

    // echo $form->field($model, 'hora_confirmacao')->widget(TimePicker::classname(), [
    //     'options' => ['readonly' => true,'disabled' => true,],
    //     'pluginOptions' => [
    //     'autoclose' => true,
    //     'showSeconds' => false,
    //     'showMeridian' => false,
    // ]
//]);
    ?>


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
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
