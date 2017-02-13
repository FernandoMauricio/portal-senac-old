<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = 'Relatório Modelo B';
$this->params['breadcrumbs'][] = 'Relatórios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="relatorios">

  <h1><?= Html::encode($this->title) ?></h1>

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>

    <?php $form = ActiveForm::begin(['options'=>['target'=>'_blank']]); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                <?php
                    $data_unidades = ArrayHelper::map($unidades, 'uni_codunidade', 'uni_nomeabreviado');
                    echo $form->field($model, 'relat_unidade')->widget(Select2::classname(), [
                            'data' =>  $data_unidades,
                            'options' => ['placeholder' => 'Selecione a Unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                ?>
                </div>
                <div class="col-md-3">
                <?php
                    $data_ano = ArrayHelper::map($ano, 'an_codano', 'an_ano');
                    echo $form->field($model, 'relat_codano')->widget(Select2::classname(), [
                            'data' =>  $data_ano,
                            'options' => ['placeholder' => 'Selecione o ano...'],
                            'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                ?>
				</div>
			</div>

        <?= Html::a('Gerar Relatório', ['gerar-relatorio'], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>