<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manut_transporte\models\MotoristaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motoristas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorista-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>


    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Motorista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php

$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'descricao',

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
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

        'toolbar' => [
            '{toggleData}',
        ],
        
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes de Motoristas Cadastrados', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Motoristas</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>
</div>
