<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\modules\manut_transporte\models\TipoCarga;
use app\modules\manut_transporte\models\Motorista;
use app\modules\manut_transporte\models\Unidades;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manut_transporte\models\TransporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Solicitações de Transporte  ';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

<div class="transporte-index">

    <h1><?= Html::encode($this->title) . '<small>Pendentes</small>'  ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
$gridColumns = [
            'id',
            'usuario_solic_nome',
            
            'unidade_solic',

            [
                'attribute' => 'data_solicitacao',
                'format' => ['date', 'php:d/m/Y'],
                'width' => '190px',
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
                'attribute'=>'tipo_carga_label', 
                'vAlign'=>'middle',
                'width'=>'160px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a($model->tipoCarga->descricao);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(TipoCarga::find()->orderBy('idtipo_carga')->asArray()->all(), 'descricao', 'descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipo'],
                'format'=>'raw'
            ],


            [
                'attribute' => 'bairro_id',
                'value' => 'bairro.descricao',
                 'contentOptions' =>['style' => 'width:30px'],
            ],

            [
                'attribute'=>'motorista_label', 
                'width'=>'5%',
                'value'=> 'motorista.descricao',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Motorista::find()->asArray()->all(), 'descricao', 'descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Motorista'],
                'format'=>'raw'
            ],


            [
                'attribute' => 'data_confirmacao',
                'format' => ['date', 'php:d/m/Y'],
                'width'=>'5%',
                'hAlign' => 'center',
                'filter'=> DatePicker::widget([
                'model' => $searchModel, 
                'attribute' => 'data_confirmacao',
                'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'yyyy-mm-dd',
                ]
            ])
            ],

             'hora_confirmacao',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {encerrar}',
            'buttons' => [

            //VISUALIZAR SOLICITAÇÃO DE TRANSPORTE
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Visualizar'),
                                   ]);
            },

            //VISUALIZAR SOLICITAÇÃO DE TRANSPORTE
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Atualizar'),
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
    'columns'=>$gridColumns,
    //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK,
            'autoXlFormat'=>true,

        ],

 'exportConfig' => [
        kartik\export\ExportMenu::EXCEL => true,
        kartik\export\ExportMenu::PDF => true,
    ],  

'toolbar' => [
        '{toggleData}',
        '{export}',
    ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Transporte Pendentes', 'options'=>['colspan'=>8, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'condensed' => true,
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem das Solicitações de Transporte</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>