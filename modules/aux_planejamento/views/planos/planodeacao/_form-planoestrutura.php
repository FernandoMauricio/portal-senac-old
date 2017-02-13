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
                                            'widgetContainer' => 'dynamicform_planoestrutura', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planoestrutura', // required: css class selector
                                            'widgetItem' => '.item-planoestrutura', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planoestrutura', // css class
                                            'deleteButton' => '.remove-item-planoestrutura', // css class
                                            'model' => $modelsPlanoEstrutura[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planodeacao_cod',
                                                'estruturafisica_cod',
                                                'planestr_quantidade',
                                                'planestr_tipo',
                                            ],
                                        ]); ?>


        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Equipamentos / Utensílios
                    <button type="button" class="pull-right add-item-planoestrutura btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planoestrutura"><!-- widgetContainer -->
                    <?php foreach ($modelsPlanoEstrutura as $i => $modelPlanoEstrutura): ?>
                        <div class="item-planoestrutura panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planoestrutura">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planoestrutura btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlanoEstrutura->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlanoEstrutura, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-8">
                                            <?php

                                                        $data_estruturafisica = ArrayHelper::map($estruturafisica, 'estr_cod', 'estr_descricao');
                                                        echo $form->field($modelPlanoEstrutura, "[{$i}]estruturafisica_cod")->widget(Select2::classname(), [
                                                                'data' =>  $data_estruturafisica,
                                                                'options' => ['placeholder' => 'Selecione o item...',
                                                                'onchange'=>
                                                                isset($modelPlanoEstrutura->id) ? //Irá ser verificado se será atualização ou cadastro novo
                                                                                 '
                                                                                 var select = this;
                                                                                 $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-plano-estrutura-fisica').'", { estrfisicID: $(this).val() } )
                                                                                 .done(function( data ) {

                                                                                        var $divPanelBody =  $(select).parent().parent().parent();

                                                                                        var $inputDescricao = $divPanelBody.find("input:eq(1)");

                                                                                        $inputDescricao.val(data.estr_descricao);

                                                                                     });
                                                                                 '
                                                                                 :
                                                                                 '
                                                                                 var select = this;
                                                                                 $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-plano-estrutura-fisica').'", { estrfisicID: $(this).val() } )
                                                                                 .done(function( data ) {

                                                                                        var $divPanelBody =  $(select).parent().parent().parent();

                                                                                        var $inputDescricao = $divPanelBody.find("input:eq(0)");

                                                                                        $inputDescricao.val(data.estr_descricao);

                                                                                     });
                                                                                 '
                                                                         ]]);
                                            ?>
                                         <?= $form->field($modelPlanoEstrutura, "[{$i}]planestr_descricao")->hiddenInput()->label(false) ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoEstrutura, "[{$i}]planestr_quantidade")->textInput() ?>
                                    </div>
                                    <div class="col-sm-2">
                                            <?php
                                                        echo $form->field($modelPlanoEstrutura, "[{$i}]planestr_tipo")->widget(Select2::classname(), [
                                                                'data' =>  ['Aluno'=> 'Aluno', 'Turma'=>'Turma'],
                                                                'options' => ['placeholder' => 'Selecione o tipo...'],
                                                                'pluginOptions' => [
                                                                        'allowClear' => true
                                                                    ],
                                                                ]);
                                            ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planoestrutura").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planoestrutura .panel-title-planoestrutura").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planoestrutura").on("afterDelete", function(e) {
    jQuery(".dynamicform_planoestrutura .panel-title-planoestrutura").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});
';

$this->registerJs($js);

?>