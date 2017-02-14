<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\file\FileInput;
use app\modules\siteadmin\models\Status;
use app\modules\siteadmin\models\Situacao;


/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Vestibular */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vestibular-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descVest')->textInput(['maxlength' => true]) ?>


    <?php
            echo $form->field($model, 'dataAbertura')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true,
                    
                ]
            ]
        ]);
    ?>   


    <?php
            echo $form->field($model, 'dataEncerramento')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>true,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true,
                    
                ]
            ]
        ]);
    ?>   



    <?= $form->field($model, 'curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vagas')->textInput() ?>



    <?php

    $list = ['Matutino' => 'Matutino','Vespertino' => 'Vespertino', 'Noturno'=> 'Noturno', 'Matutino / Noturno' => 'Matutino / Noturno']; 
    
    echo $form->field($model, 'turno')->radioList($list, ['inline'=>true]);

    ?>


        <?php
                $rows = Situacao::find()->all();
                $dataSituacao = ArrayHelper::map($rows, 'id', 'descricao');
                echo $form->field($model, 'situacao_id')->widget(Select2::classname(), [
                    'data' => $dataSituacao,
                    'options' => ['placeholder' => 'Selecione a situação ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
        ?> 

        <?php
                $rows = Status::find()->all();
                $data = ArrayHelper::map($rows, 'id', 'descricao');
                echo $form->field($model, 'status_id')->widget(Select2::classname(), [
                    'data' => $data,
                    'options' => ['placeholder' => 'Publicação no site ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
        ?> 


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
