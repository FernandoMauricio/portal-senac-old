<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\aux_planejamento\models\planilhas\PlanilhaJustificativasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;
$sess_planilhadecurso = $session['sess_planilhadecurso'];

$this->title = 'Justificativas para Correção ';
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Planilhas', 'url' => ['planilhas/planilhadecurso/index']];
$this->params['breadcrumbs'][] = ['label' => $sess_planilhadecurso, 'url' => ['planilhas/planilhadecurso/view', 'id' => $sess_planilhadecurso]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilha-justificativas-index">

    <h1><?= Html::encode($this->title) ."<small>Planilha de Curso: ".$sess_planilhadecurso. "</small>" ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'planijust_descricao',
            'planijust_usuario',

        ],
    ]); ?>
</div>
