<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitação de Contratação ';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

$session = Yii::$app->session;
$unidade = $session['sess_unidade'];

?>
<div class="contratacao-index">

    <h1><?= Html::encode($this->title) .'<small>'.$unidade.'</small>' ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Contratação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

                        [
                        'attribute'=>'id',
                        ],

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
                        'template' => ' {observacoes} {view} {update} {delete}',
                        'buttons' => [

                        //ENVIAR PARA CORREÇÃO E INSERIR JUSTIIFCATIVA
                        'observacoes' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                                'title' => Yii::t('app', 'Observações'),
                                   ]);
                                },

        ],
      ],
    ]; ?>

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
                ['content'=>'Detalhes da Solicitação de Contratação', 'options'=>['colspan'=>6, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Contratações</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
