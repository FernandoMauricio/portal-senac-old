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
                                            'widgetContainer' => 'dynamicform_planiconsumo', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planiconsumo', // required: css class selector
                                            'widgetItem' => '.item-planiconsumo', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planiconsumo', // css class
                                            'deleteButton' => '.remove-item-planiconsumo', // css class
                                            'model' => $modelsPlaniConsumo[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planico_codMXM',
                                                'planico_descricao',
                                                'planico_quantidade',
                                                'planico_valor',
                                                'planico_tipo',
                                            ],
                                        ]); ?>
            <p style="color:#a94442; margin-left:20px">* Ao excluir/editar qualquer material de consumo, os valores serão atualizados após atualizar a Planilha.</p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Materias de Consumo
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planiconsumo"><!-- widgetContainer -->
                    <?php foreach ($modelsPlaniConsumo as $i => $modelPlaniConsumo): ?>
                        <div class="item-planiconsumo panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planiconsumo">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planiconsumo btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlaniConsumo->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlaniConsumo, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniConsumo, "[{$i}]planico_codMXM")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-7">
                                    	<?= $form->field($modelPlaniConsumo, "[{$i}]planico_descricao")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                  		<?= $form->field($modelPlaniConsumo, "[{$i}]planico_quantidade")->textInput() ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlaniConsumo, "[{$i}]planico_valor")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlaniConsumo, "[{$i}]planico_tipo")->textInput(['readonly'=> true]) ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planiconsumo").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planiconsumo .panel-title-planiconsumo").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planiconsumo").on("afterDelete", function(e) {
    jQuery(".dynamicform_planiconsumo .panel-title-planiconsumo").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>