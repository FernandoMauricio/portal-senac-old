<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Centrocusto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centrocusto-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-3">
    <?= $form->field($model, 'cen_centrocusto')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '[9][9].[9][9].[9][9][9][9].[9][9].[9][9].[9][9].[9][9][9]',
]) ?>
    </div>

    <div class="col-md-5">
    <?= $form->field($model, 'cen_nomecentrocusto')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-2">
        <?php
                    $data_anocentrocusto = ArrayHelper::map($anocentrocusto, 'ance_coddocano', 'ance_ano');
                    echo $form->field($model, 'cen_codano')->widget(Select2::classname(), [
                            'data' =>  $data_anocentrocusto,
                            'options' => ['placeholder' => 'Selecione o Ano...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'cen_codsituacao')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <?php
                    $data_segmento = ArrayHelper::map($segmento, 'seg_codsegmento', 'seg_descricao');
                    echo $form->field($model, 'cen_codsegmento')->widget(Select2::classname(), [
                            'data' =>  $data_segmento,
                            'options' => ['placeholder' => 'Selecione o Segmento...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>

    <div class="col-md-6">
        <?php
                    $data_tipoacao = ArrayHelper::map($tipoacao, 'tip_codtipoa', 'tip_descricao');
                    echo $form->field($model, 'cen_codtipoacao')->widget(Select2::classname(), [
                            'data' =>  $data_tipoacao,
                            'options' => ['placeholder' => 'Selecione o Tipo de Ação...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <?php
                    $data_unidades = ArrayHelper::map($unidades, 'uni_codunidade', 'uni_nomeabreviado');
                    echo $form->field($model, 'cen_codunidade')->widget(Select2::classname(), [
                            'data' =>  $data_unidades,
                            'options' => ['id' => 'unidade-id', 'placeholder' => 'Selecione a Unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
        ?>
    </div>

    <div class="col-md-6">
        <?php
                  // Child # 1
                  echo $form->field($model, 'cen_coddepartamento')->widget(DepDrop::classname(), [
                      'type'=>DepDrop::TYPE_SELECT2,
                      'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                      'options'=>['id'=>'segmento-id'],
                      'pluginOptions'=>[
                          'depends'=>['unidade-id'],
                          'placeholder'=>'Selecione o Departamento...',
                          'initialize' => true,
                          'url'=>Url::to(['/aux_planejamento/cadastros/centrocusto/departamento'])
                      ]
                  ]);


        ?>
    </div>
</div>

<div class="row">


    <div class="col-md-4">
    <?= $form->field($model, 'cen_usuario')->textInput(['readonly' => true]) ?>
    </div>

    <div class="col-md-3">
    <?= $form->field($model, 'cen_data')->textInput(['readonly' => true]) ?>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
