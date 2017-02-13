<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\TransporteAdminEncerradasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transporte-admin-encerradas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_solicitacao') ?>

    <?= $form->field($model, 'descricao_transporte') ?>

    <?= $form->field($model, 'local') ?>

    <?= $form->field($model, 'bairro_id') ?>

    <?php // echo $form->field($model, 'data_prevista') ?>

    <?php // echo $form->field($model, 'hora_prevista') ?>

    <?php // echo $form->field($model, 'data_confirmacao') ?>

    <?php // echo $form->field($model, 'hora_confirmacao') ?>

    <?php // echo $form->field($model, 'tipo_solic_id') ?>

    <?php // echo $form->field($model, 'tipocarga_id') ?>

    <?php // echo $form->field($model, 'situacao_id') ?>

    <?php // echo $form->field($model, 'motorista_id') ?>

    <?php // echo $form->field($model, 'idusuario_solic') ?>

    <?php // echo $form->field($model, 'usuario_solic_nome') ?>

    <?php // echo $form->field($model, 'idusuario_suport') ?>

    <?php // echo $form->field($model, 'usuario_suport_nome') ?>

    <?php // echo $form->field($model, 'usuario_encerramento') ?>

    <?php // echo $form->field($model, 'data_encerramento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
