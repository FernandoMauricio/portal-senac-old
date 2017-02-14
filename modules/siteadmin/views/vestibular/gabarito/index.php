<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\vestibular\GabaritoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;

$this->params['breadcrumbs'][] = ['label' => 'Vestibular - Fatese', 'url' => ['vestibular/index']];
$this->params['breadcrumbs'][] = ['label' => $session['sess_abertura'], 'url' => ['vestibular/view', 'id' =>$session['sess_vestibular']]];
$this->title = 'Listagem de Gabaritos';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="gabarito-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Inserir Gabarito', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomeGabarito',
            [
                         'label'=>'Arquivo',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url = "http://localhost/siteadmin/web/" . $model->arquivoGabarito;
                             return Html::a($model->arquivoGabarito, $url, ['target'=> '_blank']); 
                         }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
