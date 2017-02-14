<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\BannersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'src',
            //'anexo',
            
               [
        'attribute' => 'nome',
        'format' => 'html',    
        'value' => function ($data) {
            return Html::img(Yii::getAlias('@web').'/'. $data['nome'],
                ['width' => '400px']);
                    },
                ],


            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}'],
        ],
    ]); ?>

</div>
