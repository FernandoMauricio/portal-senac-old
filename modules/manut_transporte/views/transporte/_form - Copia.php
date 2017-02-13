<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Transporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_transporte')->textInput(['value'=>'Transporte','readonly'=>true]) ?>

    <?= $form->field($model, 'data_solicitacao')->textInput(['readonly'=>true]) ?>


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


    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_transporte')->textarea(['rows' => 6]) ?>

    <?php

            echo $form->field($model, 'data_prevista')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]);

    ?>

    <?php

    echo $form->field($model, 'hora_prevista')->widget(TimePicker::classname(), [
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
        'autoclose' => true,
        'showSeconds' => false,
                'showMeridian' => false,
    ]
]);
    ?>

    <?= $form->field($model, 'situacao_id')->textInput() ?>


        <?php
                    // $data_motoristas = ArrayHelper::map($motoristas, 'id', 'descricao');
                    // echo $form->field($model, 'motorista_id')->widget(Select2::classname(), [
                    //     'data' => $data_motoristas,
                    //     'options' => ['placeholder' => 'Selecione um motorista...'],
                    //     'pluginOptions' => [
                    //         'allowClear' => true
                    //     ],
                    // ]);                    
         ?> 

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Solicitação de Transporte' : 'Criar Solicitação de Transporte', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
