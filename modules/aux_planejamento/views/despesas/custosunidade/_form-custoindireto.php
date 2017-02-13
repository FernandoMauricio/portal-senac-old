<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Custosunidade */
/* @var $form yii\widgets\ActiveForm */
?>

 <?php DynamicFormWidget::begin([
                                            'widgetContainer' => 'dynamicform_custoindireto', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-custoindireto', // required: css class selector
                                            'widgetItem' => '.item-custoindireto', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 1, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-custoindireto', // css class
                                            'deleteButton' => '.remove-item-custoindireto', // css class
                                            'model' => $modelsCustosIndireto[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'salas_id',
                                                'custin_capmaximo',
                                                'custin_metragem',
                                                'custin_ambienteDN',
                                            ],
                                        ]); ?>


        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Salas
                    <button type="button" class="pull-right add-item-custoindireto btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-custoindireto"><!-- widgetContainer -->
                    <?php foreach ($modelsCustosIndireto as $i => $modelCustosIndireto): ?>
                        <div class="item-custoindireto panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-custoindireto">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-custoindireto btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelCustosIndireto->isNewRecord) {
                                        echo Html::activeHiddenInput($modelCustosIndireto, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-6">
                                    <?php
                                         $data_salas = ArrayHelper::map($salas, 'sal_codsala', 'sal_descricao');
                                         echo $form->field($modelCustosIndireto, "[{$i}]salas_id")->widget(Select2::classname(), [
                                                 'data' =>  $data_salas,
                                                 'options' => ['placeholder' => 'Selecione a Sala...']
                                                 ]);
                                      ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelCustosIndireto, "[{$i}]custin_ambienteDN")->textInput() ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelCustosIndireto, "[{$i}]custin_capmaximo")->textInput() ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelCustosIndireto, "[{$i}]custin_metragem")->textInput() ?>
                                    </div>
                                    
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>


<?php
$js = '
jQuery(".dynamicform_custoindireto").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_custoindireto .panel-title-custoindireto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_custoindireto").on("afterDelete", function(e) {
    jQuery(".dynamicform_custoindireto .panel-title-custoindireto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>
