<?php
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="panel panel-default">
                                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-bookmark"></i> Listagem de Cursos Complementares</h4></div>
                                    <div class="panel-body">
                                         <?php DynamicFormWidget::begin([
                                            'widgetContainer' => 'dynamicform_complemento', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-complementos', // required: css class selector
                                            'widgetItem' => '.complemento', // required: css class
                                            'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                            'min' => 1, // 0 or 1 (default 1)
                                            'insertButton' => '.add-complemento', // css class
                                            'deleteButton' => '.remove-complemento', // css class
                                            'model' => $modelsComplemento[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'cursos',
                                                'certificado',
                                                'curriculos_id',
                                            ],
                                        ]); ?>

                                        <div class="container-complementos"><!-- widgetContainer -->
                                        <?php foreach ($modelsComplemento as $i => $modelComplemento): ?>
                                            <div class="complemento panel panel-default"><!-- widgetBody -->
                                                <div class="panel-heading">
                                                    <h3 class="panel-title pull-left">Curso Complementar</h3>
                                                    <div class="pull-right">
                                                        <button type="button" class="add-complemento btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                                        <button type="button" class="remove-complemento btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="panel-body">
                                                
                                                    <?php
                                                        // necessary for update action.
                                                        if (! $modelComplemento->isNewRecord) {
                                                            echo Html::activeHiddenInput($modelComplemento, "[{$i}]id");
                                                        }
                                                    ?>

                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <?= $form->field($modelComplemento, "[{$i}]cursos")->textInput(['maxlength' => true]) ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?= $form->field($modelComplemento, "[{$i}]certificado")->radioList([1 =>'Sim', 0 =>'Não'], ['inline'=>true]) ?>
                                                        </div>
                                                    </div><!-- .row -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                        <?php DynamicFormWidget::end(); ?>
                                    </div>
                                    </div>