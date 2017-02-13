<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;

?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h5 class="panel-title"> Despesas com Docente</h5>
  </div>
                <table class="table"> 
                    <thead> 
                        <tr>    
                            <th>Descrição</th>
                            <th>Encargos</th>
                            <th>Valor</th>
                            <th>DSR</th>
                            <th>Planejamento</th>
                            <th>Produtividade</th>
                            <th>Valor Hora/Aula</th>
                            <th>Carga Horária</th>
                        </tr> 
                    </thead> 
                        <?php foreach ($modelsPlaniDespDocente as $i => $modelPlaniDespDocente): ?>
                    <tbody> 
                        <tr class="default"> 

                                            <td style="width: 300px;"><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_descricao")->textInput(['readonly'=> true]) ?></td>

                                            <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_encargos")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control']
                                                                                ]); ?></td>

                                            <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_valor")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['class' => 'form-control']
                                                                                ]); ?></td>
                                            
                                            <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_dsr")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control']
                                                                                ]); ?></td>

                                            <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_planejamento")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control']
                                                                                ]); ?></td>
                                            
                                            <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_produtividade")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control']
                                                                                ]); ?></td>

                                            <th><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_valorhoraaula")->widget(\yii\widgets\MaskedInput::className(), [
                                                                                        'clientOptions' => [
                                                                                        'alias' => 'decimal',
                                                                                        'digits' => 2,
                                                                                        ],
                                                                                        'options' => ['readonly' => true, 'class' => 'form-control','style'=>'color:red']
                                                                                ]); ?></th>

                                           <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_cargahoraria")->textInput() ?></td>

                                           <td><?= $form->field($modelPlaniDespDocente, "[{$i}]planides_valorhidden")->hiddenInput()->label(false); ?></td>
                                            </tr> 
                        <?php endforeach; ?>
            </tbody> 
        </table>
</div>