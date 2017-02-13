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
                                            'widgetContainer' => 'dynamicform_planimaterial', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planimaterial', // required: css class selector
                                            'widgetItem' => '.item-planimaterial', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planimaterial', // css class
                                            'deleteButton' => '.remove-item-planimaterial', // css class
                                            'model' => $modelsPlaniMaterial[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planima_titulo',
                                                'planima_codmxm',
                                                'planima_valor',
                                                'planima_arquivo',
                                                'planima_tipomaterial',
                                                'planima_editora',
                                                'planima_observacao',
                                                'planima_nivelUC',
                                            ],
                                        ]); ?>
            <p style="color:#a94442; margin-left:20px">* Ao excluir qualquer material didático, os valores serão atualizados após atualizar a Planilha.</p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Materias Didáticos
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planimaterial"><!-- widgetContainer -->
                    <?php foreach ($modelsPlaniMaterial as $i => $modelPlaniMaterial): ?>
                        <div class="item-planimaterial panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planimaterial">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planimaterial btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlaniMaterial->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlaniMaterial, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_nivelUC")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_codmxm")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                    	<?= $form->field($modelPlaniMaterial, "[{$i}]planima_titulo")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                  		<?= $form->field($modelPlaniMaterial, "[{$i}]planima_valor")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_tipoplano")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_tipomaterial")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_editora")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <?= $form->field($modelPlaniMaterial, "[{$i}]planima_observacao")->textInput(['readonly'=> true]) ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planimaterial").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planimaterial .panel-title-planimaterial").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planimaterial").on("afterDelete", function(e) {
    jQuery(".dynamicform_planimaterial .panel-title-planimaterial").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>