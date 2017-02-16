<?php
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;
?>

<div class="panel panel-default">
                                        <div class="panel-heading"><h4><i class="glyphicon glyphicon-briefcase"></i> Listagem de Empregos Anteriores</h4></div>
                                        <div class="panel-body">
                                             <?php DynamicFormWidget::begin([
                                                'widgetContainer' => 'dynamicform_empregos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                                'widgetBody' => '.container-empregos', // required: css class selector
                                                'widgetItem' => '.emprego', // required: css class
                                                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                                'min' => 1, // 0 or 1 (default 1)
                                                'insertButton' => '.add-emprego', // css class
                                                'deleteButton' => '.remove-emprego', // css class
                                                'model' => $modelsEmpregos[0],
                                                'formId' => 'dynamic-form',
                                                'formFields' => [
                                                    'empresa',
                                                    'cidade',
                                                    'cargo',
                                                    'atividades',
                                                    'inicio',
                                                    'termino',
                                                    'curriculos_id',
                                                ],
                                            ]); ?>

                                            <div class="container-empregos"><!-- widgetContainer -->
                                            <?php foreach ($modelsEmpregos as $i => $modelEmpregos): ?>
                                                <div class="emprego panel panel-default"><!-- widgetBody -->
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title pull-left">Emprego Anterior</h3>
                                                        <div class="pull-right">
                                                            <button type="button" class="add-emprego btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                                            <button type="button" class="remove-emprego btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel-body">
                                                    
                                                        <?php
                                                            // necessary for update action.
                                                            if (! $modelEmpregos->isNewRecord) {
                                                                echo Html::activeHiddenInput($modelEmpregos, "[{$i}]id");
                                                            }
                                                        ?>
                                                        <div class="row">                                                         
                                                            <div class="col-sm-8">
                                                                <?= $form->field($modelEmpregos, "[{$i}]empresa")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?= $form->field($modelEmpregos, "[{$i}]cidade")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                        </div><!-- .row -->

                                                        <div class="row">                                                         
                                                            <div class="col-sm-6">
                                                                <?= $form->field($modelEmpregos, "[{$i}]cargo")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                            
                                                            <div class="col-sm-2">                                                     
                                                            <?php
                                                                echo '<label class="control-label">Data de Inicio</label>';
                                                                echo MaskedInput::widget([
                                                                    'model' => $modelEmpregos,
                                                                    'attribute' => "[{$i}]inicio",
                                                                    'name' => "Data de Inicio",
                                                                    'mask' => '99/99/9999',
                                                                ]);
                                                            ?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                             <?php
                                                                echo '<label class="control-label">Data de Término</label>';
                                                                echo MaskedInput::widget([
                                                                    'model' => $modelEmpregos,
                                                                    'attribute' => "[{$i}]termino",
                                                                    'name' => "Data de Término",
                                                                    'mask' => '99/99/9999',
                                                                ]);
                                                            ?>
                                                            </div>
                                                        </div><!-- .row -->

                                                        <div class="row">                                                         
                                                            <div class="col-sm-12">
                                                                <?= $form->field($modelEmpregos, "[{$i}]atividades")->textarea(['rows'=>2]) ?>
                                                            </div>
                                                        </div><!-- .row -->


                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                            <?php DynamicFormWidget::end(); ?>
                                        </div>
                                    </div>
