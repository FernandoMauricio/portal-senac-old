<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\comunicacaointerna\models\DespachocomunicacaoDecoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despachos Pendentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despachocomunicacao-deco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Despachocomunicacao Deco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'deco_coddespacho',
            'deco_codcomunicacao',
            //'deco_codcolaborador',
            'deco_codunidade',
            'com_titulo',
            //'deco_codcargo',
            // 'deco_data',
            // 'deco_despacho:ntext',
             'deco_codsituacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
