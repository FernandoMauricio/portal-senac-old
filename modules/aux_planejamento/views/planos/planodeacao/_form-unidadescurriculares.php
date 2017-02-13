<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;

use wbraganca\dynamicform\DynamicFormWidget;

?>

                                         <?php DynamicFormWidget::begin([
                                            'widgetContainer' => 'dynamicform_unidadecurricular', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-unidadecurricular', // required: css class selector
                                            'widgetItem' => '.item-unidadecurricular', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-unidadecurricular', // css class
                                            'deleteButton' => '.remove-item-unidadecurricular', // css class
                                            'model' => $modelsUnidadesCurriculares[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'nivel_uc',
                                                'uncu_descricao',
                                                'uncu_cargahoraria',
                                            ],
                                        ]); ?>


        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Unidades Curriculares
                    <button type="button" class="pull-right add-item-unidadecurricular btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-unidadecurricular"><!-- widgetContainer -->
                    <?php foreach ($modelsUnidadesCurriculares as $i => $modelUnidadeCurricular): ?>
                        <div class="item-unidadecurricular panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-unidadecurricular">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-unidadecurricular btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelUnidadeCurricular->isNewRecord) {
                                        echo Html::activeHiddenInput($modelUnidadeCurricular, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-2">
                                    <?php
                                        $nivelListUC=ArrayHelper::map(app\modules\aux_planejamento\models\planos\NivelUnidadesCurriculares::find()->all(), 'nivuc_id', 'nivuc_descricao' ); 
                                                    echo $form->field($modelUnidadeCurricular, "[{$i}]nivel_uc")->widget(Select2::classname(), [
                                                            'data' =>  $nivelListUC,
                                                            'options' => ['placeholder' => 'Selecione o Nivel da UC...'],
                                                            'pluginOptions' => [
                                                                    'allowClear' => true
                                                                ],
                                                            ]);
                                    ?>
                                    </div>

                                    <div class="col-sm-8">
                                      <?= $form->field($modelUnidadeCurricular, "[{$i}]uncu_descricao")->textInput() ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelUnidadeCurricular, "[{$i}]uncu_cargahoraria")->textInput() ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>


<?php

$js = '
jQuery(".dynamicform_unidadecurricular").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_unidadecurricular .panel-title-unidadecurricular").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_unidadecurricular").on("afterDelete", function(e) {
    jQuery(".dynamicform_unidadecurricular .panel-title-unidadecurricular").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>