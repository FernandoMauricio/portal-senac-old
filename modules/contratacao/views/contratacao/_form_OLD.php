<?php

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\modules\contratacao\models\Recrutamento;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */
/* @var $form yii\widgets\ActiveForm */

$session = Yii::$app->session;
$unidade = $session['sess_unidade'];

?>

<div class="contratacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_colaborador')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'cod_unidade_solic')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'colaborador')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'unidade')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'quant_pessoa')->textInput() ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 3]) ?>



    <?php ActiveForm::end(); ?>



    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>


    <?php echo '<label class="control-label">Substituição:</label><br>'; ?> 
    <?= $form->field($model, 'substituicao')->radioList(array('0'=>'Não','1'=>'Sim')); ?>
    <?= $form->field($model, 'nome_substituicao')->textInput(['maxlength' => true]) ?>

    <br><br>

    <?php echo '<label class="control-label">Período Determinado:</label><br>'; ?> 
    <?= $form->field($model, 'periodo')->radioList(array('0'=>'Não','1'=>'Sim')); ?>
    <?= $form->field($model, 'tempo_periodo')->textInput() ?>

    <br><br>

    <?php echo '<label class="control-label">Necessidade de aumento do quadro de pessoal:</label><br>'; ?> 
    <?= $form->field($model, 'aumento_quadro')->radioList(array('0'=>'Não','1'=>'Sim')); ?>

    <br><br>

    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo '<label class="control-label">Data prevista do ingresso do futuro contratado(a):</label><br>';
    echo MaskedInput::widget([
    'name' => 'data_ingresso',
    'clientOptions' => ['alias' =>  'mm/dd/yyyy']
]);

    ?>

    <?php ActiveForm::end(); ?>


    <br>


    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">Poderá ser recrutado e selecionado candidato portador de algum tipo de deficiência:</label><br>'; ?> 
    <?= $form->field($model, 'deficiencia')->radioList(array('0'=>'Não','1'=>'Sim')); ?>

    <?php ActiveForm::end(); ?>

    <br>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'obs_deficiencia')->textarea(['rows' => 3]) ?>

    <?php ActiveForm::end(); ?>



    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">--- Ensino Fundamental:</label><br>'; ?> 

    <?= $form->field($model, 'fundamental_comp')->checkbox() ?>

    <?= $form->field($model, 'fundamental_inc')->checkbox() ?>

    <?php ActiveForm::end(); ?>


    <br>

    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">--- Ensino Médio:</label><br>'; ?> 

    <?= $form->field($model, 'medio_comp')->checkbox() ?>

    <?= $form->field($model, 'medio_inc')->checkbox() ?>

    <?php ActiveForm::end(); ?>


    <br>

    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">--- Ensino Técnico:</label><br>'; ?> 

    <?= $form->field($model, 'tecnico_comp')->checkbox() ?>

    <?= $form->field($model, 'tecnico_inc')->checkbox() ?>

    <?= $form->field($model, 'tecnico_area')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

    <br>


    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">--- Ensino Superior:</label><br>'; ?> 

    <?= $form->field($model, 'superior_comp')->checkbox() ?>

    <?= $form->field($model, 'superior_inc')->checkbox() ?>

    <?= $form->field($model, 'superior_area')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

    <br>

    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">--- Pós-Graduação:</label><br>'; ?> 

    <?= $form->field($model, 'pos_comp')->checkbox() ?>

    <?= $form->field($model, 'pos_inc')->checkbox() ?>

    <?= $form->field($model, 'pos_area')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>


    <br>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'dominio_atividade')->textarea(['rows' => 3]) ?>

    <?php ActiveForm::end(); ?>




    <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

    <?php echo '<label class="control-label">Domínio de informática:</label><br>'; ?> 

    <?= $form->field($model, 'windows')->checkbox() ?>

    <?= $form->field($model, 'word')->checkbox() ?>

    <?= $form->field($model, 'excel')->checkbox() ?>

    <?= $form->field($model, 'internet')->checkbox() ?>

    <?php ActiveForm::end(); ?>

<br>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'experiencia')->textInput() ?>

    <?= $form->field($model, 'experiencia_tempo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experiencia_atividade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jornada_horas')->textInput() ?>

    <?= $form->field($model, 'jornada_obs')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'principais_atividades')->textarea(['rows' => 3]) ?>

    <?php ActiveForm::end(); ?>


        <?php $form = ActiveForm::begin(['id' => 'login-form-inline','type' => ActiveForm::TYPE_INLINE,'formConfig' => ['showErrors' => true]]); ?>

        <?php

echo '<label class="control-label">Métodos de recrutamento indicados:</label><br>';
                $rows = Recrutamento::find()->all();
                $data = ArrayHelper::map($rows, 'idrecrutamento', 'descricao');
                echo $form->field($model, 'recrutamento_id')->radiolist($data, ['inline'=>true]);


    ?> 



<br><br>

    <?php echo '<label class="control-label">Métodos de seleção indicados, considerando um ou mais dos seguintes processos:</label><br>'; ?> 

    <?= $form->field($model, 'selec_dinamica')->checkbox() ?>

    <?= $form->field($model, 'selec_prova')->checkbox() ?>

    <?= $form->field($model, 'selec_entrevista')->checkbox() ?>

    <?= $form->field($model, 'selec_teste')->checkbox(['maxlength' => true]) ?>


    <?php ActiveForm::end(); ?>
<br>




    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomesituacao')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'situacao_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
