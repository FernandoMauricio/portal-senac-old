<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Segmento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="segmento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'seg_descricao')->textInput(['maxlength' => true]) ?>

        <?php
                    $data_eixo = ArrayHelper::map($eixo, 'eix_codeixo', 'eix_descricao');
                    echo $form->field($model, 'seg_codeixo')->widget(Select2::classname(), [
                            'data' =>  $data_eixo,
                            'options' => ['placeholder' => 'Selecione o eixo...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>


    <?= $form->field($model, 'seg_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
