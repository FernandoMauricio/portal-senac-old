<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratacaoEncerradaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_solicitacao') ?>

    <?= $form->field($model, 'hora_solicitacao') ?>

    <?= $form->field($model, 'cod_colaborador') ?>

    <?= $form->field($model, 'colaborador') ?>

    <?php // echo $form->field($model, 'cargo') ?>

    <?php // echo $form->field($model, 'cod_unidade_solic') ?>

    <?php // echo $form->field($model, 'unidade') ?>

    <?php // echo $form->field($model, 'quant_pessoa') ?>

    <?php // echo $form->field($model, 'motivo') ?>

    <?php // echo $form->field($model, 'substituicao') ?>

    <?php // echo $form->field($model, 'periodo') ?>

    <?php // echo $form->field($model, 'tempo_periodo') ?>

    <?php // echo $form->field($model, 'aumento_quadro') ?>

    <?php // echo $form->field($model, 'obs_aumento') ?>

    <?php // echo $form->field($model, 'nome_substituicao') ?>

    <?php // echo $form->field($model, 'deficiencia') ?>

    <?php // echo $form->field($model, 'obs_deficiencia') ?>

    <?php // echo $form->field($model, 'data_ingresso') ?>

    <?php // echo $form->field($model, 'fundamental_comp') ?>

    <?php // echo $form->field($model, 'fundamental_inc') ?>

    <?php // echo $form->field($model, 'medio_comp') ?>

    <?php // echo $form->field($model, 'medio_inc') ?>

    <?php // echo $form->field($model, 'tecnico_comp') ?>

    <?php // echo $form->field($model, 'tecnico_inc') ?>

    <?php // echo $form->field($model, 'tecnico_area') ?>

    <?php // echo $form->field($model, 'superior_comp') ?>

    <?php // echo $form->field($model, 'superior_inc') ?>

    <?php // echo $form->field($model, 'superior_area') ?>

    <?php // echo $form->field($model, 'pos_comp') ?>

    <?php // echo $form->field($model, 'pos_inc') ?>

    <?php // echo $form->field($model, 'pos_area') ?>

    <?php // echo $form->field($model, 'dominio_atividade') ?>

    <?php // echo $form->field($model, 'windows') ?>

    <?php // echo $form->field($model, 'word') ?>

    <?php // echo $form->field($model, 'excel') ?>

    <?php // echo $form->field($model, 'internet') ?>

    <?php // echo $form->field($model, 'experiencia') ?>

    <?php // echo $form->field($model, 'experiencia_tempo') ?>

    <?php // echo $form->field($model, 'experiencia_atividade') ?>

    <?php // echo $form->field($model, 'jornada_horas') ?>

    <?php // echo $form->field($model, 'jornada_obs') ?>

    <?php // echo $form->field($model, 'principais_atividades') ?>

    <?php // echo $form->field($model, 'recrutamento_id') ?>

    <?php // echo $form->field($model, 'selec_curriculo') ?>

    <?php // echo $form->field($model, 'selec_dinamica') ?>

    <?php // echo $form->field($model, 'selec_prova') ?>

    <?php // echo $form->field($model, 'selec_entrevista') ?>

    <?php // echo $form->field($model, 'selec_teste') ?>

    <?php // echo $form->field($model, 'situacao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
