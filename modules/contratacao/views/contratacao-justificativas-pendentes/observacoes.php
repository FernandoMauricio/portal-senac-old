<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoJustificativasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;
$id_contratacao = $session['sess_contratacao'];

$this->title = 'Justificativas para Correção  ';
$this->params['breadcrumbs'][] = ['label' => 'Solicitação de Contratação', 'url' => ['contratacao/index']];
$this->params['breadcrumbs'][] = ['label' => $id_contratacao, 'url' => ['contratacao/view', 'id' => $id_contratacao]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="contratacao-justificativas-index">

    <h1><?= Html::encode($this->title) ."<small>Solicitação de Contratação: ".$id_contratacao. "</small>" ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descricao',
            'usuario',
        ],
    ]); ?>

</div>
