<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Forum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($forum, 'mensagem')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($forum->isNewRecord ? 'Enviar Mensagem' : 'Enviar Mensagem', ['class' => $forum->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
