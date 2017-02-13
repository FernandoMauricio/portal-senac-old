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
                                            'widgetContainer' => 'dynamicform_planiequipamento', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planiequipamento', // required: css class selector
                                            'widgetItem' => '.item-planiequipamento', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planiequipamento', // css class
                                            'deleteButton' => '.remove-item-planiequipamento', // css class
                                            'model' => $modelsPlaniEquipamento[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planieq_descricao',
                                                'planieq_quantidade',
                                                'planieq_tipo',
                                            ],
                                        ]); ?>

	        <div class="panel panel-default">
	                <div class="panel-heading">
	                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Equipamentos / Utensílios
	                    <div class="clearfix"></div>
	                </div>
	                <div class="panel-body container-items-planiequipamento"><!-- widgetContainer -->
	                    <?php foreach ($modelsPlaniEquipamento as $i => $modelPlaniEquipamento): ?>
	                        <div class="item-planiequipamento panel panel-default"><!-- widgetBody -->
	                            <div class="panel-heading">
	                                <span class="panel-title-planiequipamento">Item: <?= ($i + 1) ?></span>
	                                <button type="button" class="pull-right remove-item-planiequipamento btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div class="panel-body">
	                                <?php
	                                    // necessary for update action.
	                                    if (!$modelPlaniEquipamento->isNewRecord) {
	                                        echo Html::activeHiddenInput($modelPlaniEquipamento, "[{$i}]id");
	                                    }
	                                ?>
	                                    <div class="col-sm-8">
	                                    	<?= $form->field($modelPlaniEquipamento, "[{$i}]planieq_descricao")->textInput(['readonly'=> true]) ?>
	                                    </div>

	                                    <div class="col-sm-2">
	                                  		<?= $form->field($modelPlaniEquipamento, "[{$i}]planieq_quantidade")->textInput(['readonly'=> true]) ?>
	                                    </div>

	                                    <div class="col-sm-2">
	                                        <?= $form->field($modelPlaniEquipamento, "[{$i}]planieq_tipo")->textInput(['readonly'=> true]) ?>
	                                    </div>


	                            </div>
	                        </div>
	                    <?php endforeach; ?>
	                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planiequipamento").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planiequipamento .panel-title-planiequipamento").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planiequipamento").on("afterDelete", function(e) {
    jQuery(".dynamicform_planiequipamento .panel-title-planiequipamento").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>