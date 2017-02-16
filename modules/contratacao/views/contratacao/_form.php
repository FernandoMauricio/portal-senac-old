<?php

use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\modules\contratacao\models\Recrutamento;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>   

    <?= $form->field($model, 'colaborador')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'unidade')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'quant_pessoa')->textInput() ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 3]) ?>

                                <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>12,
                                'attributes'=>[
                                    'substituicao'=>['type'=>Form::INPUT_RADIO_LIST, 'items' => ['0'=>'Não','1'=>'Sim'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],       
                                    'nome_substituicao'=>['type'=>Form::INPUT_TEXT,  'options'=>['placeholder'=>'Informe o nome do servidor...'],'columnOptions'=>['colspan'=>4]],
                                            ],
                            ]);
                            ?>


                                <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>12,
                                'attributes'=>[
                                    'periodo'=>['type'=>Form::INPUT_RADIO_LIST, 'items' => ['0'=>'Não','1'=>'Sim'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],       
                                    'tempo_periodo'=>['type'=>Form::INPUT_TEXT,  'options'=>['placeholder'=>'Informe o período em meses...'],'columnOptions'=>['colspan'=>4]],
                                            ],
                            ]);
                            ?>


    <?= $form->field($model, 'aumento_quadro')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'obs_aumento')->textarea(['rows' => 3]) ?>

        <?php
        echo $form->field($model, 'data_ingresso')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Insira a data ...'],
            'pluginOptions' => [
                'autoclose'=>true
            ]
        ]);

        ?>

    <?= $form->field($model, 'deficiencia')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'obs_deficiencia')->textarea(['rows' => 3]) ?>


    <center><div>--------------------------------------------------<strong style="color: #E61238"> IDENTIFICAÇÃO DO PERFIL </strong>--------------------------------------------------</center></div>

                            <?php
                            echo '<label class="control-label">--- Ensino Fundamental:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'fundamental_comp'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'fundamental_inc'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                            ],
                            ]);
                            ?>

                            <?php
                            echo '<label class="control-label">--- Ensino Médio:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'medio_comp'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'medio_inc'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                            ],
                            ]);
                            ?>

                            <?php
                            echo '<label class="control-label">--- Ensino Técnico:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'tecnico_comp'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'tecnico_inc'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    'tecnico_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a área...'],'columnOptions'=>['colspan'=>8]],
                                            ],
                            ]);
                            ?>

                            <?php
                            echo '<label class="control-label">--- Ensino Superior:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'superior_comp'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'superior_inc'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    'superior_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a área...'],'columnOptions'=>['colspan'=>8]],
                                            ],
                            ]);
                            ?>

                            <?php
                            echo '<label class="control-label">--- Pós-Graduação:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'pos_comp'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'pos_inc'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    'pos_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a área...'],'columnOptions'=>['colspan'=>8]],
                                            ],
                            ]);
                            ?>


    <?= $form->field($model, 'dominio_atividade')->textarea(['rows' => 3]) ?>


                            <?php
                            echo '<label class="control-label">Domínio de informática:</label><br>'; 
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>10,
                                'attributes'=>[
                                    'windows'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],       
                                    'word'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    'excel'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    'internet'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true]],
                                    
                                            ],
                            ]);
                            ?>



                            <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>12,
                                'attributes'=>[
                                    'experiencia'=>['type'=>Form::INPUT_RADIO_LIST, 'items' => ['0'=>'Não','1'=>'Sim'],'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]],       
                                    'experiencia_tempo'=>['type'=>Form::INPUT_TEXT,  'options'=>['placeholder'=>'Informe o tempo de experiência...'],'columnOptions'=>['colspan'=>4]],
                                    'experiencia_atividade'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a atividade...'],'columnOptions'=>['colspan'=>4]],
                                            ],
                            ]);
                            ?>


    <?= $form->field($model, 'jornada_horas')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'jornada_obs')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'principais_atividades')->textarea(['rows' => 3]) ?>

    <?php

                $rows = Recrutamento::find()->all();
                $data = ArrayHelper::map($rows, 'idrecrutamento', 'descricao');
                echo $form->field($model, 'recrutamento_id')->radiolist($data, ['inline'=>true]);

    ?>



                            <?php
                            echo '<label class="control-label">Métodos de seleção indicados, considerando um ou mais dos seguintes processos:</label><br>';
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>12,
                                'attributes'=>[
                                    'selec_curriculo'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],
                                    'selec_dinamica'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]],       
                                    'selec_prova'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true],'columnOptions'=>['colspan'=>3]], 
                                    'selec_entrevista'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]], 
                                    'selec_teste'=>['type'=>Form::INPUT_CHECKBOX,'options'=>['inline'=>true],'columnOptions'=>['colspan'=>2]], 
                                    
                                            ],
                            ]);
                            ?>

                            <?php 
                         $options = \yii\helpers\ArrayHelper::map($sistemas, 'idsistema', 'descricao');
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>12,
                                'attributes'=>[
                                    'permissions'=>['type'=>Form::INPUT_CHECKBOX_LIST,'items'=> $options,'options'=>['inline'=>true]], 
                                    
                                            ],
                            ]);
                            ?>




    <?= $form->field($model, 'nomesituacao')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'situacao_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar Solicitação' : 'Atualizar Solicitação', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
