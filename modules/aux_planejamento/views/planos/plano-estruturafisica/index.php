<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planos\PlanoEstruturafisicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plano Estruturafisicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-estruturafisica-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Plano Estruturafisica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'planestr_cod',
            'planodeacao_cod',
            'estruturafisica_cod',
            'quantidade',
            'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
