<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = 'Configuração de Entrada de Dados Modelo A';
$this->params['breadcrumbs'][] = ['label' => 'Listagem Modelo A', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Configuração de Entrada de Dados Modelo A';
?>

<div class="configuracao-entrada-dados-modelo-a">

  <h1><?= Html::encode($this->title) ?></h1>

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>

    <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                <?php
                    $data_ano = ArrayHelper::map($ano, 'an_ano', 'an_ano');
                    echo $form->field($model, 'moda_anoexercicio')->widget(Select2::classname(), [
                            'data' =>  $data_ano,
                            'options' => ['placeholder' => 'Selecione o ano...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                ?>
				</div>
                <div class="col-md-4">
                <?php
                    $data_entradaModeloA = ArrayHelper::map($entradaModeloA,'enta_codentrada', 'enta_entrada');
                    echo $form->field($model, 'moda_codentrada')->widget(Select2::classname(), [
                            'data' =>  $data_entradaModeloA,
                            'options' => ['placeholder' => 'Selecione a Entrada de Dados...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                ?>
				</div>
			</div>

        <?= Html::a('Gravar Dados', ['configuracao-entrada-dados-modelo-a'], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post'
            ],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>