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
                        <div class="col-md-5">

                        <?= $form->field($model, 'plan_descricao')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-2">

                        <?= $form->field($model, 'plan_cargahoraria')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-2">

                        <?= $form->field($model, 'plan_status')->radioList([1 => 'Ativo', 0 => 'Inativo']) ?>

                        </div>

                        <div class="col-md-3">

                        <?= $form->field($model, 'plan_modelonacional')->radioList([1 => 'Sim', 0 => 'Não']) ?>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                $nivelList=ArrayHelper::map(app\modules\aux_planejamento\models\cadastros\Nivel::find()->all(), 'niv_codnivel', 'niv_descricao' ); 
                                        echo $form->field($model, 'plan_codnivel')->widget(Select2::classname(), [
                                                'data' =>  $nivelList,
                                                'options' => ['placeholder' => 'Selecione o Nivel...'],
                                                'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]);
                            ?>

                        </div>

                        <div class="col-md-3">
                            <?php
                                $EixoList=ArrayHelper::map(app\modules\aux_planejamento\models\cadastros\Eixo::find()->all(), 'eix_codeixo', 'eix_descricao' ); 
                                            echo $form->field($model, 'plan_codeixo')->widget(Select2::classname(), [
                                                    'data' =>  $EixoList,
                                                    'options' => ['id' => 'eixo-id','placeholder' => 'Selecione o Eixo...'],
                                                    'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]);
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
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
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php
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
