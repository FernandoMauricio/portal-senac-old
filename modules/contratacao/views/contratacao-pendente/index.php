<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoPendenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contratações Pendentes';
$this->params['breadcrumbs'][] = $this->title;

//Get all flash messages and loop through them
foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
            <?php
            echo \kartik\widgets\Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
                'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                'body' => (!empty($message['message'])) ? Html::encode($message['message']) : '',
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : '',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : '',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; ?>

<div class="contratacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

$gridColumns = [
            
             [
             'class'=>'kartik\grid\ExpandRowColumn',
             'width'=>'50px',
             'format' => 'raw',
             'value'=>function ($model, $key, $index, $column) {
                 return GridView::ROW_COLLAPSED;
             },
             'detail'=>function ($model, $key, $index, $column) {
                 return Yii::$app->controller->renderPartial('/contratacao/pdf_contratacao', ['model'=>$model]);
             },
             'headerOptions'=>['class'=>'kartik-sheet-style'], 
             'expandOneOnly'=>true
             ],

            'id',
            [
                'attribute' => 'data_solicitacao',
                'format' => ['date', 'php:d/m/Y'],
            ],
            'colaborador',
            
            [
            'attribute'=>'unidade',
            'width' => '300px',
            ],
            
            [
                'attribute' => 'situacao_id',
                'value' => 'situacao.descricao',
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {iniciar} {correcao}',
            'contentOptions' => ['style' => 'width: 450px;'],
            'buttons' => [

            //VISUALIZAR
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Visualizar', $url, [
                            'class'=>'btn btn-primary btn-xs',
           
                ]);
            },

            //INICIAR PROCESSO SOLETIVO
            'iniciar' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-ok"></span> Iniciar Processo', $url, [
                            'class'=>'btn btn-success btn-xs',
                            'data' => [
                                            'confirm' => 'Você tem CERTEZA que deseja INICIAR o processo?',
                                            'method' => 'post',
                                        ],
                ]);
            },
            
            //ENVIAR PARA CORREÇÃO E INSERIR JUSTIIFCATIVA
            'correcao' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-repeat"></span> Para Correção', $url, [
                            'class'=>'btn btn-warning btn-xs',
                ]);
           },
        ],
      ],
    ];
 ?>

    <?php Pjax::begin(); ?>

    <?php 

    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>false, // pjax is set to always true for this demo
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes da Solicitação de Contratação', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Contratações Pendentes</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
