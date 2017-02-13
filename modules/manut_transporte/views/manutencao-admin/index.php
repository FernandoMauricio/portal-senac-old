<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use yii\widgets\Pjax;
use app\modules\manut_transporte\models\Situacao;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\manut_transporte\models\ManutencaoAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitações de Manutenção ';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

<div class="manutencao-admin-index">

    <h1><?= Html::encode($this->title) . '<small>Pendentes</small>'  ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Solicitação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


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
            'template' => '{assumir} {view} {encerrar}',
            'contentOptions' => ['style' => 'width: 7%'],
            'buttons' => [


            //ENCERRAR SOLICITAÇÃO DE TRANSPORTE
            'assumir' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [
                            'title' => Yii::t('app', 'Assumir Solicitação'),
                            'data' => [
                                            'confirm' => 'Você tem CERTEZA que deseja ASSUMIR a solicitação?',
                                            'method' => 'post',
                                        ],
                ]);
            },

            //VISUALIZAR SOLICITAÇÃO DE TRANSPORTE
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Visualizar'),
                                   ]);
            },

            //ENCERRAR SOLICITAÇÃO DE TRANSPORTE
            'encerrar' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-floppy-save"></span>', $url, [
                            'title' => Yii::t('app', 'Encerrar Solicitação'),
                            'data' => [
                                            'confirm' => 'Você tem CERTEZA que deseja ENCERRAR a solicitação?',
                                            'method' => 'post',
                                        ],
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
