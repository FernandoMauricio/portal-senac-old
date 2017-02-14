<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Informacoes */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="informacoes-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nomeInfo')->textInput(['maxlength' => true]) ?>

    <?php

    echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => '.pdf'],
        'language' => 'pt',
        'pluginOptions' => [
        'showRemove'=> false,
        'showUpload'=> false,
        'initialCaption'=>$model->arquivoInfo,
        ],
    ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inserir' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>