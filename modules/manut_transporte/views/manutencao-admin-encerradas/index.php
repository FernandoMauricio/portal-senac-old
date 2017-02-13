<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use yii\widgets\Pjax;
use app\modules\manut_transporte\models\Situacao;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\manut_transporte\models\ManutencaoAdminEncerradasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações de Manutenção Encerradas ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-admin-encerradas-index">

 <h1><?= Html::encode($this->title) . '<small>Área Administrativa</small>'  ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],

                'id',

                [
                'attribute'=> 'usuario_solic_nome',
                'width' => '15%',
                ],

                 [
                     'attribute' => 'data_solicitacao',
                     'format' => ['date', 'php:d/m/Y'],
                     'width' => '12%',
                     'hAlign' => 'center',
                     'filter'=> DatePicker::widget([
                     'model' => $searchModel, 
                     'attribute' => 'data_solicitacao',
                     'pluginOptions' => [
                          'autoclose'=>true,
                          'format' => 'yyyy-mm-dd',
                     ]
                 ])
                 ],

                [
                'attribute'=> 'titulo',
                'width' => '25%',
                ],

                [
                'attribute'=> 'usuario_suport_nome',
                'width' => '15%',
                ],

                [
                    'attribute'=>'situacao_label', 
                    'width'=>'460px',
                    'value'=> 'situacao.nome',
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Situacao::find()->asArray()->all(), 'nome', 'nome'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Situação'],
                    'format'=>'raw'
                ],

                ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [

            //VISUALIZAR SOLICITAÇÃO DE TRANSPORTE
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Visualizar'),
                                   ]);
            },

        ],
      ],
            ];
    ?>


    <?php Pjax::begin(['id'=>'w0-pjax']); ?>

    <?php 
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'rowOptions' =>function($model){
                    if($model->situacao_id == '3' ){

                            return['class'=>'danger'];                        
                    } if($model->situacao_id == '2' ){

                            return['class'=>'info'];                        
                    }

        },
    'columns'=>$gridColumns,
    //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo

    'toolbar' => [
            '{toggleData}',
        ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Manutenção', 'options'=>['colspan'=>7, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],  
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem das Solicitações de Manutenção</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>


</div>

