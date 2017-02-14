<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\AberturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abertura de Vagas';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="abertura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Abertura de Vagas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php


$gridColumns = [  

        [   'label' => '#',
            'format' => 'raw',
            'value' => 'id',
            'contentOptions'=>['style'=>'max-width: 10px;'] // <-- right here
        ],
            'desc_abertura',
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y'],
            ],
             'unidades',
            [
                'attribute' => 'estado_id',
                'value' => 'situacao.descricao',

            ],
            [
                'attribute' => 'status_id',
                'value' => 'status.descricao',

            ],



                                ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {classificados} {comunicado} {errata} ',
                                'contentOptions' => ['style' => 'width: 380px;'],
                                'buttons' => [


                                //VISUALIZAR
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //EDITAR
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //LISTA DE CLASSIFICADOS
                                'classificados' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Classificados', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },


                                //COMUNICADOS
                                'comunicado' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Comunicados', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },

                                //ERRATA
                                'errata' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Erratas', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },


                            ],
                            ],
];



  Pjax::begin();

    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'rowOptions' =>function($model){
                    if($model->estado_id == '3')
                    {
                         return['class'=>'danger'];                        
                    }elseif ($model->estado_id == '2' ) 
                    {
                        return['class'=>'info'];
                    }else
                    {
                        return['class'=>'success'];
                    }
                },
    'pjax'=>true, // pjax is set to always true for this demo
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes da Abertura de Vagas', 'options'=>['colspan'=>6, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Abertura de Vagas </h3>',
    ],
]);



?>

   <?php Pjax::end(); ?>

</div>
