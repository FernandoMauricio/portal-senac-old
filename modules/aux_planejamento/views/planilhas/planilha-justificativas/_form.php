<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\PlanilhaJustificativas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planilha-justificativas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'planilhadecurso_id')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'planijust_usuario')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'planijust_descricao')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
