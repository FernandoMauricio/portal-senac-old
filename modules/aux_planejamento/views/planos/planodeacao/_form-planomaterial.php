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
                                            'widgetContainer' => 'dynamicform_planomaterial', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planomaterial', // required: css class selector
                                            'widgetItem' => '.item-planomaterial', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planomaterial', // css class
                                            'deleteButton' => '.remove-item-planomaterial', // css class
                                            'model' => $modelsPlanoMaterial[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'nivel_uc',
                                                'plama_codrepositorio',
                                                'plama_codmxm',
                                                'plama_valor',
                                                'plama_tipomaterial',
                                                'plama_editora',
                                                'plama_observacao',
                                                'plama_arquivo',
                                            ],
                                        ]); ?>


        <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Materias Didáticos
                    <button type="button" class="pull-right add-item-planomaterial btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planomaterial"><!-- widgetContainer -->
                    <?php foreach ($modelsPlanoMaterial as $i => $modelPlanoMaterial): ?>
                        <div class="item-planomaterial panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planomaterial">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planomaterial btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlanoMaterial->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlanoMaterial, "[{$i}]id");
                                    }
                                ?>
                                    <div class="col-sm-2">
                                    <?php
                                        $nivelListUC=ArrayHelper::map(app\modules\aux_planejamento\models\planos\NivelUnidadesCurriculares::find()->all(), 'nivuc_id', 'nivuc_descricao' ); 
                                                    echo $form->field($modelPlanoMaterial, "[{$i}]nivel_uc")->widget(Select2::classname(), [
                                                            'data' =>  $nivelListUC,
                                                            'options' => ['placeholder' => 'Selecione o Nivel da UC...'],
                                                            'pluginOptions' => [
                                                                    'allowClear' => true
                                                                ],
                                                            ]);
                                    ?>
                                    </div>
                                    
                                    <div class="col-sm-8">
                                    <?php
                                         $data_repositorio = ArrayHelper::map($repositorio, 'rep_codrepositorio', 'rep_titulo');
                                         echo $form->field($modelPlanoMaterial, "[{$i}]plama_codrepositorio")->widget(Select2::classname(), [
                                                 'data' =>  $data_repositorio,
                                                 'options' => ['placeholder' => 'Selecione o Material Didático...',
                                                 'onchange'=>
                                                 isset($modelPlanoMaterial->id) ? //Irá ser verificado se será atualização ou cadastro novo
                                                         '
                                                         var select = this;
                                                         $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-repositorio').'", { repId: $(this).val() } )
                                                         .done(function( data ) {

                                                                var $divPanelBody =  $(select).parent().parent().parent();

                                                                var $inputTitulo = $divPanelBody.find("input:eq(1)");
                                                                var $inputCodMXM = $divPanelBody.find("input:eq(2)");
                                                                var $inputValor = $divPanelBody.find("input:eq(3)");
                                                                var $inputTipoMaterial = $divPanelBody.find("input:eq(4)");
                                                                var $inputEditora = $divPanelBody.find("input:eq(5)");
                                                                var $inputArquivo = $divPanelBody.find("input:eq(7)");

                                                                $inputTitulo.val(data.rep_titulo);
                                                                $inputCodMXM.val(data.rep_codmxm);
                                                                $inputValor.val(data.rep_valor);
                                                                $inputTipoMaterial.val(data.rep_tipo);
                                                                $inputEditora.val(data.rep_editora);
                                                                $inputArquivo.val(data.rep_arquivo);

                                                                //$("#inputArquivo").attr("href", data.rep_arquivo);
                                                                
                                                             });
                                                         '
                                                         :
                                                         '
                                                         var select = this;
                                                         $.getJSON( "'.Url::toRoute('/aux_planejamento/planos/planodeacao/get-repositorio').'", { repId: $(this).val() } )
                                                         .done(function( data ) {

                                                                var $divPanelBody =  $(select).parent().parent().parent();

                                                                var $inputTitulo = $divPanelBody.find("input:eq(0)");
                                                                var $inputCodMXM = $divPanelBody.find("input:eq(1)");
                                                                var $inputValor = $divPanelBody.find("input:eq(2)");
                                                                var $inputTipoMaterial = $divPanelBody.find("input:eq(3)");
                                                                var $inputEditora = $divPanelBody.find("input:eq(4)");
                                                                var $inputArquivo = $divPanelBody.find("input:eq(6)");

                                                                $inputTitulo.val(data.rep_titulo);
                                                                $inputCodMXM.val(data.rep_codmxm);
                                                                $inputValor.val(data.rep_valor);
                                                                $inputTipoMaterial.val(data.rep_tipo);
                                                                $inputEditora.val(data.rep_editora);
                                                                $inputArquivo.val(data.rep_arquivo);
                                                                
                                                             });
                                                         '

                                                 ]]);
                                      ?>
                                      <?= $form->field($modelPlanoMaterial, "[{$i}]plama_titulo")->hiddenInput()->label(false) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoMaterial, "[{$i}]plama_codmxm")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoMaterial, "[{$i}]plama_valor")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoMaterial, "[{$i}]plama_tipomaterial")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlanoMaterial, "[{$i}]plama_editora")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                            <?php
                                                echo $form->field($modelPlanoMaterial, "[{$i}]plama_tipoplano")->widget(Select2::classname(), [
                                                        'data' =>  ['Plano A' => 'Plano A', 'Plano B' => 'Plano B'],
                                                        'options' => ['placeholder' => 'Selecione o tipo de plano...'],
                                                        'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ]);
                                            ?>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <?= $form->field($modelPlanoMaterial, "[{$i}]plama_observacao")->textInput() ?>
                                    </div>

                                    <div class="col-sm-12">
                                   <?= $form->field($modelPlanoMaterial, "[{$i}]plama_arquivo")->hiddenInput()->label(false) ?>
                                   <?php //echo '<a id="inputArquivo" target="_blank"> Download do Arquivo</a>' ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>


<?php
$js = '
jQuery(".dynamicform_planomaterial").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planomaterial .panel-title-planomaterial").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planomaterial").on("afterDelete", function(e) {
    jQuery(".dynamicform_planomaterial .panel-title-planomaterial").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>