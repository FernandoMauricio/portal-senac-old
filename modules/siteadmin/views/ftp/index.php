<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\FtpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arquivos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>


<div class="ftp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo arquivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                         'label'=>'nome',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url = "http://www.am.senac.br/anexos/" . $model->nome;
                             return Html::a($model->nome, $url, ['target'=> '_blank']); 
                         }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
