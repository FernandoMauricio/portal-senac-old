<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;
use app\modules\aux_planejamento\models\cadastros\Eixo;
use app\modules\aux_planejamento\models\cadastros\Segmento;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\Planodeacao */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="planodeacao-form">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">

                        <?= $form->field($model, 'plan_descricao')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-2">

                        <?= $form->field($model, 'plan_cargahoraria')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-3">

                        <?= $form->field($model, 'plan_status')->radioList([1 => 'Liberado', 0 => 'Em elaboração']) ?>

                        </div>

                        <div class="col-md-3">

                        <?= $form->field($model, 'plan_modelonacional')->radioList([1 => 'Sim', 0 => 'Não']) ?>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                $nivelList=ArrayHelper::map(app\modules\aux_planejamento\models\cadastros\Nivel::find()->all(), 'niv_codnivel', 'niv_descricao' ); 
                            if ($model->isNewRecord) {
                                       echo  $form->field($model, 'plan_codnivel')->widget(Select2::classname(), [
                                                'data' =>  $nivelList,
                                                'options' => ['placeholder' => 'Selecione o Nivel...'],
                                                'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]);
                           }else{
                                     echo $form->field($model, 'nivelLabel')->textInput(['value' => $model->nivel->niv_descricao, 'readonly' => true]);
                                }
                            ?>

                        </div>

                        <div class="col-md-3">
                            <?php
                                $EixoList=ArrayHelper::map(app\modules\aux_planejamento\models\cadastros\Eixo::find()->all(), 'eix_codeixo', 'eix_descricao' ); 
                                if ($model->isNewRecord) {
                                            echo $form->field($model, 'plan_codeixo')->widget(Select2::classname(), [
                                                    'data' =>  $EixoList,
                                                    'options' => ['id' => 'eixo-id','placeholder' => 'Selecione o Eixo...'],
                                                    'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]);
                            }else{
                                     echo $form->field($model, 'eixoLabel')->textInput(['value' => $model->eixo->eix_descricao, 'readonly' => true]);
                                }
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
                            if ($model->isNewRecord) {
                                // Child # 1
                                echo $form->field($model, 'plan_codsegmento')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                    'options'=>['id'=>'segmento-id'],
                                    'pluginOptions'=>[
                                        'depends'=>['eixo-id'],
                                        'placeholder'=>'Selecione o Segmento...',
                                        'initialize' => true,
                                        'url'=>Url::to(['/aux_planejamento/planos/planodeacao/segmento'])
                                    ]
                                ]);
                            }else{
                                     echo $form->field($model, 'segmentoLabel')->textInput(['value' => $model->segmento->seg_descricao, 'readonly' => true]);
                                }
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
                            if ($model->isNewRecord) {
                                // Child # 2
                                echo $form->field($model, 'plan_codtipoa')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                    'pluginOptions'=>[
                                        'depends'=>['segmento-id'],
                                        'placeholder'=>'Selecione o Tipo de Ação...',
                                        'url'=>Url::to(['/aux_planejamento/planos/planodeacao/tipos'])
                                    ]
                                ]);
                            }else{
                                     echo $form->field($model, 'tipoLabel')->textInput(['value' => $model->tipo->tip_descricao, 'readonly' => true]);
                                }
                            ?>
                        </div>

                    </div>

                        <?= $form->field($model, 'plan_sobre')->textarea(['rows' => 4]) ?>

                        <?= $form->field($model, 'plan_prerequisito')->textarea(['rows' => 4]) ?>

                        <?= $form->field($model, 'plan_perfConclusao')->textarea(['rows' => 4]) ?>

                        <?= $form->field($model, 'plan_perfTecnico')->textarea(['rows' => 4]) ?>

                        <?php    
                            $options = \yii\helpers\ArrayHelper::map($categoria, 'idcategoria', 'descricao');
                            echo $form->field($model, 'plan_categoriasPlano')->checkboxList($options); 
                        ?>
           </div>
        </div>
