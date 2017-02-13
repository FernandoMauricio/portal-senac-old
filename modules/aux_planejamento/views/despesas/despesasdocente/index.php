<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\despesas\DespesasdocenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despesas com Docente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despesasdocente-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Despesa com Docente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<?php

    $gridColumns = [
                        
                             ['class' => 'yii\grid\SerialColumn'],

                             'doce_descricao',

                             [
                                 'attribute' =>'doce_encargos',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2],
                             ],

                             [
                                 'attribute' =>'doce_valor',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2],
                             ],

                             [
                                 'attribute' =>'doce_dsr',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2]
                             ],

                             [
                                 'attribute' =>'doce_planejamento',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2]
                             ],

                             [
                                 'attribute' =>'doce_produtividade',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2]
                             ],

                             [
                                 'attribute' =>'doce_valorhoraaula',
                                 'contentOptions' => ['class' => 'col-lg-1'],
                                 'format'=>['decimal',2]
                             ],            

                             [
                                 'class'=>'kartik\grid\BooleanColumn',
                                 'attribute'=>'doce_status', 
                                 'vAlign'=>'middle'
                             ], 

                             ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
                    
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
                ['content'=>'Detalhes de Despesas com Docentes', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],
                ['content'=>'Cálculos Realizados', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
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