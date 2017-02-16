<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

?>

                    <?= $form->field($model, 'edital')->textInput(['readonly'=>true]) ?>

                        <?php
                                    $data_cargos = ArrayHelper::map($cargos, 'descricao', 'descricao');
                                    echo $form->field($model, 'cargo')->widget(Select2::classname(), [
                                        'data' => array_merge(["" => ""], $data_cargos),
                                        'options' => ['placeholder' => 'Selecione o cargo...'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                         ?>


                    <?= $form->field($model, 'nome')->textInput(['maxlength' => true,'placeholder' => 'Nome completo...']) ?>

                    <?php

                      echo  $form->field($model, "datanascimento")->widget(DateControl::classname(), [
                        'type'=>DateControl::FORMAT_DATETIME,
                        'displayFormat' => 'dd/MM/yyyy',
                        'autoWidget' => false,
                        'widgetClass' => 'yii\widgets\MaskedInput',
                        'options' => [
                           'mask' => '99/99/9999',
                           'options' => ['class'=>'form-control', 'placeholder' => 'Data nascimento...'],
                         ]
                    ]); 

                    ?>

                    <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       // 2 column layout
                                    'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu CPF...']],
                                    'identidade'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu RG...']],
                                    'orgao_exped'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe o orgão expedidor...']],
                                    'sexo'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Masculino', false=>'Feminino'], 'options'=>['inline'=>true]],
                                            ],
                            ]);
                    ?>

                    <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       // 2 column layout
                                    'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail...']],
                                    'emailAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail alternativo...']],
                                    'telefone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone...']],
                                    'telefoneAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone alternativo...']],
                                ]
                            ]);
                    ?>
                       
                    <?php $form->field($model, 'cpf')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999.999.999-99']) ?>

                    <?php $form->field($model, 'telefone')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>

                    <?php $form->field($model, 'telefoneAlt')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>