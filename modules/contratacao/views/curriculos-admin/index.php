<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<?php

$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'edital',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'numeroInscricao',
            'options' => ['width' => '20px'],
            ],

            'cargo',
            'nome',

            [
            'attribute'=>'cpf',
            'options' => ['width' => '140px'],
            ],

            [
            'attribute'=>'idade',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'email',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'telefone',
            'options' => ['width' => '20px'],
            ],

            [
                'class'=>'kartik\grid\BooleanColumnCurriculos',
                'attribute'=>'classificado',
                'vAlign'=>'middle',
            ], 
 
            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {classificar} {desclassificar}',
                        'contentOptions' => ['style' => 'width: 240px;'],
                        'buttons' => [

                        //VISUALIZAR
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                        'class'=>'btn btn-primary btn-xs',
                                        'title' => Yii::t('app', 'Visualizar candidato'),
                       
                            ]);
                        },

                        //CLASSIFICAR CANDIDATO
                        'classificar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, [
                                        'class'=>'btn btn-success btn-xs',
                                        'title' => Yii::t('app', 'Classificar candidato'),
                                         'data' => [
                                                   //'confirm' => 'Você tem certeza que deseja ENCERRAR essa Solicitação de Contratação?',
                                                   'method' => 'post',

                                                   ],
                            ]);
                        },
                        
                        //DESCLASSIFICAR CANDIDATO
                        'desclassificar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Desclassificar candidato'),
                                         'data' => [
                                                   //'confirm' => 'Você tem certeza que deseja ENVIAR PARA CORREÇÃO essa Solicitação de Contratação?',
                                                   'method' => 'post',
                                                   ],
                       
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
                ['content'=>'Detalhes de Curriculos Cadastrados', 'options'=>['colspan'=>12, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Curriculos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>




</div>

