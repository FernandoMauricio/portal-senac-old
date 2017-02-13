<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planos\PlanoMaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plano Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-material-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Plano Material', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProviderPlanoMaterial,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'plama_codplama',
            'plama_codplano',
            'plama_codtiplama',
            'plama_codrepositorio',
            'plama_titulo',
            // 'plama_valor',
            // 'plama_arquivo',
            // 'plama_tipomaterial',
            // 'plama_observacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
