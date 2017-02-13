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
                                            'widgetContainer' => 'dynamicform_planoconsumo', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planoconsumo', // required: css class selector
                                            'widgetItem' => '.item-planoconsumo', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planoconsumo', // css class
                                            'deleteButton' => '.remove-item-planoconsumo', // css class
                                            'model' => $modelsPlanoConsumo[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planodeacao_cod',
                                                'planmatcon_codMXM',
                                                'materialconsumo_cod',
                                                'planmatcon_descricao',
                                                'planmatcon_quantidade',
                                                'planmatcon_valor',
                                                'planmatcon_tipo',
                                            ],
                                        ]); ?>


        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Materiais de Consumo
                    <button type="button" class="pull-right add-item-planoconsumo btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planoconsumo"><!-- widgetContainer -->
                    <?php foreach ($modelsPlanoConsumo as $i => $modelPlanoConsumo): ?>
                        <div class="item-planoconsumo panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planoconsumo">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planoconsumo btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlanoConsumo->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlanoConsumo, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-7">
                                    <?php
                                         $data_planoconsumo = ArrayHelper::map($materialconsumo, 'matcon_id', 'matcon_descricao');
                                         echo $form->field($modelPlanoConsumo, "[{$i}]materialconsumo_cod")->widget(Select2::classname(), [
                                                 'data' =>  $data_planoconsumo,
                                                 'options' => ['placeholder' => 'Selecione o Material de Consumo...',
                                                 'onchange'=>
                                                  isset($modelPlanoConsumo->id) ? //Irá ser verificado se será atualização ou cadastro novo
                                                         '
                                                         var select = this;
                                                         $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-plano-consumo').'", { matconId: $(this).val() } )
                                                         .done(function( data ) {

                                                                var $divPanelBody =  $(select).parent().parent().parent();

                                                                var $inputDescricao = $divPanelBody.find("input:eq(1)");
                                                                var $inputCodMXM    = $divPanelBody.find("input:eq(2)");
                                                                var $inputTipo      = $divPanelBody.find("input:eq(3)");
                                                                var $inputValor     = $divPanelBody.find("input:eq(4)");
                                                                
                                                                $inputCodMXM.val(data.matcon_codMXM);
                                                                $inputDescricao.val(data.matcon_descricao);
                                                                $inputValor.val(data.matcon_valor);
                                                                $inputTipo.val(data.matcon_tipo);

                                                             });
                                                         '
                                                         :
                                                         '
                                                         var select = this;
                                                         $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-plano-consumo').'", { matconId: $(this).val() } )
                                                         .done(function( data ) {

                                                                var $divPanelBody =  $(select).parent().parent().parent();

                                                                var $inputDescricao = $divPanelBody.find("input:eq(0)");
                                                                var $inputCodMXM    = $divPanelBody.find("input:eq(1)");
                                                                var $inputTipo      = $divPanelBody.find("input:eq(2)");
                                                                var $inputValor     = $divPanelBody.find("input:eq(3)");

                                                                $inputCodMXM.val(data.matcon_codMXM);
                                                                $inputDescricao.val(data.matcon_descricao);
                                                                $inputValor.val(data.matcon_valor);
                                                                $inputTipo.val(data.matcon_tipo);

                                                             });
                                                         '
                                                 ]]);
                                      ?>
                                      <?= $form->field($modelPlanoConsumo, "[{$i}]planmatcon_descricao")->hiddenInput()->label(false) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoConsumo, "[{$i}]planmatcon_codMXM")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlanoConsumo, "[{$i}]planmatcon_tipo")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlanoConsumo, "[{$i}]planmatcon_valor")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlanoConsumo, "[{$i}]planmatcon_quantidade")->textInput() ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>


<?php

$js = '
jQuery(".dynamicform_planoconsumo").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planoconsumo .panel-title-planoconsumo").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planoconsumo").on("afterDelete", function(e) {
    jQuery(".dynamicform_planoconsumo .panel-title-planoconsumo").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>