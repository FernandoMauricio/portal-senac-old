<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\vestibular\InformacoesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;

$this->params['breadcrumbs'][] = ['label' => 'Vestibular - Fatese', 'url' => ['vestibular/index']];
$this->params['breadcrumbs'][] = ['label' => $session['sess_abertura'], 'url' => ['vestibular/view', 'id' =>$session['sess_vestibular']]];
$this->title = 'Listagem de Informações';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="informacoes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Inserir Informações', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomeInfo',
            [
                         'label'=>'Arquivo',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url = "http://localhost/siteadmin/web/" . $model->arquivoInfo;
                             return Html::a($model->arquivoInfo, $url, ['target'=> '_blank']); 
                         }
            ],


            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
