<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\modules\aux_planejamento\models\base\Unidade;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planilhas\PrecificacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Precificação de Custo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="precificacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $session = Yii::$app->session;
        if($session['sess_codunidade'] == 51) { //ÁREA DO GPO
    ?>
            <p>
                <?= Html::a('Nova', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
    <?php
        }
    ?>

<?php
    $gridColumns = [
                    [
                        'class'=>'kartik\grid\ExpandRowColumn',
                        'width'=>'5%',
                        'value'=>function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail'=>function ($model, $key, $index, $column) {
                            return Yii::$app->controller->renderPartial('/planilhas/precificacao/view_expand', ['model'=>$model]);
                        },
                        'headerOptions'=>['class'=>'kartik-sheet-style'],
                        'expandOneOnly'=>true,
                    ],

                    [
                    'attribute'=>'planp_codunidade', 
                    'width'=>'30%',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return $model->unidade->uni_nomeabreviado;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Unidade::find()->where(['uni_codsituacao' => 1, 'uni_coddisp' => 1])->orderBy('uni_nomeabreviado')->asArray()->all(), 'uni_codunidade', 'uni_nomeabreviado'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                         'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
                         'group'=>true,  // enable grouping
                    ],

                    [
                      'attribute'=>'planp_ano',
                      'width'=>'5%',
                    ],

                    [
                      'attribute'=>'planp_id',
                      'width'=>'5%',
                    ],


                    [
                      'attribute'=>'labelCurso',
                      'value'=> 'planodeacao.plan_descricao',
                    ],

                    [
                      'attribute'=>'planp_cargahoraria',
                      'width'=>'5%',
                    ],  

                    [
                      'attribute'=>'planp_qntaluno',
                      'width'=>'5%',
                    ],    

                    [
                      'attribute'=>'planp_precosugerido',
                      'format' => 'currency',
                      'width'=>'5%',
                    ], 

                    [
                      'label' => 'Nº Min Aluno',
                      'attribute'=>'planp_minimoaluno',
                      'width'=>'5%',
                    ], 

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ];
     ?>


 <?php Pjax::begin(['id'=>'w0-pjax']); ?>

    <?php 

    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'condensed' => true,
    'hover' => true,
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes da Precificação de Custo', 'options'=>['colspan'=>9, 'class'=>'text-center warning']],
                ['content'=>'Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],

        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Custos da Unidade </h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>