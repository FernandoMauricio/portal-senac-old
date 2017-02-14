<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\siteadmin\models\ComunicadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;

$this->params['breadcrumbs'][] = ['label' => 'Abertura de Vagas', 'url' => ['abertura/index']];
$this->params['breadcrumbs'][] = ['label' => $session['sess_abertura'], 'url' => ['abertura/view', 'id' =>$session['sess_abertura']]];
$this->title = 'Listagem de Comunicados';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="comunicado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Inserir Comunicado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nomeComunicado',
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y'],
            ],
            [
                         'label'=>'Arquivo',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url = "http://localhost/siteadmin/web/" . $model->arquivoComunicado;
                             return Html::a($model->arquivoComunicado, $url, ['target'=> '_blank']); 
                         }
            ],


           ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
