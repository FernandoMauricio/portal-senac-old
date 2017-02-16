<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_solicitacao')->textInput() ?>

    <?= $form->field($model, 'hora_solicitacao')->textInput() ?>

    <?= $form->field($model, 'cod_colaborador')->textInput() ?>

    <?= $form->field($model, 'colaborador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_unidade_solic')->textInput() ?>

    <?= $form->field($model, 'unidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quant_pessoa')->textInput() ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'substituicao')->textInput() ?>

    <?= $form->field($model, 'periodo')->textInput() ?>

    <?= $form->field($model, 'tempo_periodo')->textInput() ?>

    <?= $form->field($model, 'aumento_quadro')->textInput() ?>

    <?= $form->field($model, 'obs_aumento')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'nome_substituicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deficiencia')->textInput() ?>

    <?= $form->field($model, 'obs_deficiencia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data_ingresso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fundamental_comp')->textInput() ?>

    <?= $form->field($model, 'fundamental_inc')->textInput() ?>

    <?= $form->field($model, 'medio_comp')->textInput() ?>

    <?= $form->field($model, 'medio_inc')->textInput() ?>

    <?= $form->field($model, 'tecnico_comp')->textInput() ?>

    <?= $form->field($model, 'tecnico_inc')->textInput() ?>

    <?= $form->field($model, 'tecnico_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'superior_comp')->textInput() ?>

    <?= $form->field($model, 'superior_inc')->textInput() ?>

    <?= $form->field($model, 'superior_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_comp')->textInput() ?>

    <?= $form->field($model, 'pos_inc')->textInput() ?>

    <?= $form->field($model, 'pos_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dominio_atividade')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'windows')->textInput() ?>

    <?= $form->field($model, 'word')->textInput() ?>

    <?= $form->field($model, 'excel')->textInput() ?>

    <?= $form->field($model, 'internet')->textInput() ?>

    <?= $form->field($model, 'experiencia')->textInput() ?>

    <?= $form->field($model, 'experiencia_tempo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experiencia_atividade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jornada_horas')->textInput() ?>

    <?= $form->field($model, 'jornada_obs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'principais_atividades')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'recrutamento_id')->textInput() ?>

    <?= $form->field($model, 'selec_curriculo')->textInput() ?>

    <?= $form->field($model, 'selec_dinamica')->textInput() ?>

    <?= $form->field($model, 'selec_prova')->textInput() ?>

    <?= $form->field($model, 'selec_entrevista')->textInput() ?>

    <?= $form->field($model, 'selec_teste')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'situacao_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
