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
                                            'widgetContainer' => 'dynamicform_planimatalun', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-items-planimatalun', // required: css class selector
                                            'widgetItem' => '.item-planimatalun', // required: css class
                                            'limit' => 999, // the maximum times, an element can be cloned (default 999)
                                            'min' => 0, // 0 or 1 (default 1)
                                            'insertButton' => '.add-item-planimatalun', // css class
                                            'deleteButton' => '.remove-item-planimatalun', // css class
                                            'model' => $modelsPlaniMateriaisAluno[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'id',
                                                'planimatalun_valor',
                                                'planimatalun_quantidade',
                                                'planimatalun_descricao',
                                                'planimatalun_unidade',
                                                'planimatalun_tipo',
                                            ],
                                        ]); ?>
            <p style="color:#a94442; margin-left:20px">* Ao excluir/editar qualquer material do aluno, os valores serão atualizados após atualizar a Planilha.</p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i> Listagem de Materias do Aluno
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-items-planimatalun"><!-- widgetContainer -->
                    <?php foreach ($modelsPlaniMateriaisAluno as $i => $modelPlaniMateriaisAluno): ?>
                        <div class="item-planimatalun panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-planimatalun">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-planimatalun btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelPlaniMateriaisAluno->isNewRecord) {
                                        echo Html::activeHiddenInput($modelPlaniMateriaisAluno, "[{$i}]id");
                                    }
                                ?>

                                    <div class="col-sm-5">
                                    	<?= $form->field($modelPlaniMateriaisAluno, "[{$i}]planimatalun_descricao")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMateriaisAluno, "[{$i}]planimatalun_quantidade")->textInput() ?>
                                    </div>

                                    <div class="col-sm-2">
                                  		<?= $form->field($modelPlaniMateriaisAluno, "[{$i}]planimatalun_valor")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelPlaniMateriaisAluno, "[{$i}]planimatalun_unidade")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelPlaniMateriaisAluno, "[{$i}]planimatalun_tipo")->textInput(['readonly'=> true]) ?>
                                    </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>

<?php

$js = '
jQuery(".dynamicform_planimatalun").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_planimatalun .panel-title-planimatalun").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_planimatalun").on("afterDelete", function(e) {
    jQuery(".dynamicform_planimatalun .panel-title-planimatalun").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>