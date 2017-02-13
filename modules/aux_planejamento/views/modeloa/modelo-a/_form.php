<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\modeloa\ModeloA */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modelo-a-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Formulário de Cadastro do Modelo A</h3>
          </div>
            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 1: Informações do Modelo A</th></tr>
              </thead>
            </table>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'anoLabel')->textInput(['value' => $model->anoModeloA->an_ano,'readonly' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'moda_centrocustoreduzido')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'moda_nomecentrocusto')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'entradaDadosLabel')->textInput(['value' => $model->entradaModeloA->enta_entrada,'readonly' => true]) ?>
                </div>

                <div class="col-md-2">
                <?php
                        $data_situacaomodeloa = ArrayHelper::map($situacaoModeloA, 'simoa_codsituacao', 'simoa_situacao');
                        echo $form->field($model, 'moda_codsituacao')->widget(Select2::classname(), [
                                'data' =>  $data_situacaomodeloa,
                                'options' => ['placeholder' => 'Situação...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'moda_descriminacaoprojeto')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>

            <table class="table table-condensed table-hover">
              <thead>
                <tr class="info"><th colspan="12">SEÇÃO 2: Elemento, Subelemento e Item de Despesa</th></tr>
              </thead>
            </table>

        <?= $this->render('_form-detalhesmodeloa', [
            'form' => $form,
            'model' => $model,
            'modelsDetalhesModeloA'  => $modelsDetalhesModeloA,
        ]) ?>

    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
