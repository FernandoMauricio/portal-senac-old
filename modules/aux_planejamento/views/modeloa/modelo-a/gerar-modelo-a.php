<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>
<div class="modelo-a-gerar-modelo-a" style="text-align: center;">

    <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                <?php
                    $data_ano = ArrayHelper::map($ano, 'an_codano', 'an_ano');
                    echo $form->field($model, 'moda_codano')->widget(Select2::classname(), [
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
                    $data_tipoProgramacao = ArrayHelper::map($tipoProgramacao, 'tipro_codprogramacao', 'tipro_descricao');
                    echo $form->field($model, 'moda_codsituacao')->radioList($data_tipoProgramacao) 
                ?>
				</div>
			</div>
		</div>

        <?= Html::a('Gerar Modelo A', ['gerar-modelo-a'], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post'
            ],
        ]) ?>

    <?php ActiveForm::end(); ?>

</div>