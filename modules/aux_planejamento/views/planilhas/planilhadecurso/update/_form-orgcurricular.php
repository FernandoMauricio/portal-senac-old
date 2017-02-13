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
                                            'widgetContainer' => 'dynamicform_planiuc', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planiuc', // required: css class selector
                                            'widgetItem' => '.item-planiuc', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planiuc', // css class
                                            'deleteButton' => '.remove-item-planiuc', // css class
                                            'model' => $modelsPlaniUC[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planiuc_descricao',
                                                'planiuc_cargahoraria',
                                                'planiuc_nivelUC',
                                            ],
                                        ]); ?>

	        <div class="panel panel-default">
	                <div class="panel-heading">
	                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Unidades Curriculares
	                    <div class="clearfix"></div>
	                </div>
	                <div class="panel-body container-items-planiuc"><!-- widgetContainer -->
	                    <?php foreach ($modelsPlaniUC as $i => $modelPlaniUC): ?>
	                        <div class="item-planiuc panel panel-default"><!-- widgetBody -->
	                            <div class="panel-heading">
	                                <span class="panel-title-planiuc">Item: <?= ($i + 1) ?></span>
	                                <button type="button" class="pull-right remove-item-planiuc btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div class="panel-body">
	                                <?php
	                                    // necessary for update action.
	                                    if (!$modelPlaniUC->isNewRecord) {
	                                        echo Html::activeHiddenInput($modelPlaniUC, "[{$i}]id");
	                                    }
	                                ?>
	                                    <div class="col-sm-2">
	                                        <?= $form->field($modelPlaniUC, "[{$i}]planiuc_nivelUC")->textInput(['readonly'=> true]) ?>
	                                    </div>

	                                    <div class="col-sm-8">
	                                    	<?= $form->field($modelPlaniUC, "[{$i}]planiuc_descricao")->textInput(['readonly'=> true]) ?>
	                                    </div>

	                                    <div class="col-sm-2">
	                                  		<?= $form->field($modelPlaniUC, "[{$i}]planiuc_cargahoraria")->textInput(['readonly'=> true]) ?>
	                                    </div>
	                            </div>
	                        </div>
	                    <?php endforeach; ?>
	                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planiuc").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planiuc .panel-title-planiuc").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planiuc").on("afterDelete", function(e) {
    jQuery(".dynamicform_planiuc .panel-title-planiuc").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>