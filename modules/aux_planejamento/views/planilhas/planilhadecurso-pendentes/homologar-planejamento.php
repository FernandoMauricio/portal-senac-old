<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>
<div class="planilhadecurso-admin-homologar-planejamento" style="text-align: center;">

    <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                <?php
                    $data_unidades = ArrayHelper::map($unidades, 'uni_codunidade', 'uni_nomeabreviado');
                    echo $form->field($model, 'placu_codunidade')->widget(Select2::classname(), [
                            'data' =>  $data_unidades,
                            'hideSearch' => true,
                            'options' => ['placeholder' => 'Selecione uma unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
				</div>
                <div class="col-md-4">
                <?php 
                    $data_tipoProgramacao = ArrayHelper::map($tipoProgramacao, 'tipro_codprogramacao', 'tipro_descricao');
                    echo $form->field($model, 'placu_codprogramacao')->radioList($data_tipoProgramacao) 
                ?>
				</div>
			</div>
		</div>

        <?= Html::a('Homologar!', ['homologar-planejamento'], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post'
            ],
        ]) ?>

    <?php ActiveForm::end(); ?>

</div>