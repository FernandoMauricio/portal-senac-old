<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdminEncerradas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-admin-encerradas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_solicitacao')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_manut')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idusuario_solic')->textInput() ?>

    <?= $form->field($model, 'usuario_solic_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idusuario_suport')->textInput() ?>

    <?= $form->field($model, 'usuario_suport_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_encerramento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_encerramento')->textInput() ?>

    <?= $form->field($model, 'cod_unidade_solic')->textInput() ?>

    <?= $form->field($model, 'cod_unidade_suport')->textInput() ?>

    <?= $form->field($model, 'tipo_solic_id')->textInput() ?>

    <?= $form->field($model, 'situacao_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
