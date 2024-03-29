<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\aux_planejamento\models\solicitacoes\Situacao;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\solicitacoes\MaterialCopiasPendentesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

$this->title = 'Solicitações de Cópias Pendentes';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="material-copias-pendentes-index">

   <h1><?= Html::encode($this->title) ?></h1>

<?php

    $gridColumns = [

                            [
                                'class'=>'kartik\grid\ExpandRowColumn',
                                'width'=>'50px',
                                'value'=>function ($model, $key, $index, $column) {
                                    return GridView::ROW_COLLAPSED;
                                },
                                'detail'=>function ($model, $key, $index, $column) {
                                    return Yii::$app->controller->renderPartial('/solicitacoes/material-copias/view_expand', ['model'=>$model]);
                                },
                                'headerOptions'=>['class'=>'kartik-sheet-style'],
                                'expandOneOnly'=>true,
                            ],

                            [
                              'attribute'=>'matc_id',
                              'width'=>'5%'
                            ],

                            [
                              'attribute'=>'matc_centrocusto',
                              'width'=>'5%'
                            ],


                            [
                              'attribute'=>'matc_unidade',
                              'value'=> 'unidade.uni_nomeabreviado',
                              'width'=>'20%'
                            ],

                            'matc_curso',


                            [
                                'attribute'=>'situacao_id', 
                                'vAlign'=>'middle',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return Html::a($model->situacao->sitmat_descricao);
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                'filter'=>ArrayHelper::map(Situacao::find()->orderBy('sitmat_status')->asArray()->all(), 'sitmat_descricao', 'sitmat_descricao'), 
                                'filterInputOptions'=>['placeholder'=>'Situação'],
                                'format'=>'raw'
                            ],


                                ['class' => 'yii\grid\ActionColumn',
                                'template' => '{aprovar} {reprovar}',
                                'options' => ['width' => '15%'],
                                'buttons' => [

                                //APROVAR REQUISIÇÃO
                                'aprovar' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span> Aprovar', $url, [
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => Yii::t('app', 'Aprovar Solicitação'),
                                                'data'  => [
                                                    'confirm' => 'Você tem CERTEZA que deseja APROVAR a solicitação?',
                                                    'method' => 'post',
                                                     ],
                                                ]);
                                            },

                                //REPROVAR REQUISIÇÃO
                                'reprovar' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-remove"></span> Reprovar', $url, [
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => Yii::t('app', 'Reprovar Solicitação'),
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
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    'condensed' => true,
    'hover' => true,
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes das Solicitações de Cópias', 'options'=>['colspan'=>6, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
            ],
        ]
    ],

        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Solicitações Pendentes</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

