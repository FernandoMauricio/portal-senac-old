<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\vestibular\VestibularSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vestibular - Fatese';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>


<div class="vestibular-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Vestibular', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php

$gridColumns = [  

        [   'label' => '#',
            'format' => 'raw',
            'value' => 'idVest',
            'contentOptions'=>['style'=>'max-width: 10px;'] // <-- right here
        ],
            'descVest',

            [
                'attribute' => 'dataAbertura',
                'format' => ['date', 'php:d/m/Y'],
            ],

            [
                'attribute' => 'dataEncerramento',
                'format' => ['date', 'php:d/m/Y'],
            ],

           'curso',

            [
                'attribute' => 'status_id',
                'value' => 'status.descricao',

            ],



                                ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {informacoes} {editais} {fichas-inscricoes} {gabarito} {aprovados} {matriz}',
                                'contentOptions' => ['style' => 'width: 380px;'],
                                'buttons' => [


                                //VISUALIZAR
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //ATUALIZAR
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //INFORMACOES
                                'informacoes' => function ($url, $model) {
                                     return Html::a('<span class="glyphicon glyphicon-plus"></span> Info', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //FICHAS DE INSCRICOES
                                'fichas-inscricoes' => function ($url, $model) {
                                     return Html::a('<span class="glyphicon glyphicon-plus"></span> Fichas Insc', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //LISTA DE editais
                                'editais' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Editais', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },


                                //matriz
                                'matriz' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Matriz ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },

                                //gabarito
                                'gabarito' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Gabarito', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },

                                //aprovados
                                'aprovados' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Aprovados', $url, [
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
                    if($model->situacao_id == '3')
                    {
                         return['class'=>'danger'];                        
                    }elseif ($model->situacao_id == '2' ) 
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
                ['content'=>'Detalhes do Vestibular', 'options'=>['colspan'=>6, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Vestibulares - Fatese </h3>',
    ],
]);



?>

   <?php Pjax::end(); ?>

</div>
