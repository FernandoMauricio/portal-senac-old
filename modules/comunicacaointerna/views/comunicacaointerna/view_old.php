<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\comunicacaointerna\models\Comunicacaointerna;
use app\modules\comunicacaointerna\models\Destinocomunicacao;
use app\modules\comunicacaointerna\models\Cargos_car;
use app\modules\comunicacaointerna\models\Colaborador;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\comunicacaointerna\models\Comunicacaointerna */

$this->title = $model->com_codcomunicacao;
$this->params['breadcrumbs'][] = ['label' => 'Comunicação Interna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comunicacao-interna-com-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

    <?php
/**
 * THE VIEW BUTTON
 */
echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['/comunicacaointerna/pdf'], [
    'class'=>'btn btn-info', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>' Clique aqui para gerar um arquivo PDF'
]);

    ?>

<br><br>

        <?= $this->render('/comunicacaointerna/pdf', [
        'model' => $model,
        //'destinocomunicacao' => $destinocomunicacao,
        ]) ?>


</div>
