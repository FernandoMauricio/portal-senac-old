<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoMaterial */

$this->title = $model->plama_codplama;
$this->params['breadcrumbs'][] = ['label' => 'Plano Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->plama_codplama], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->plama_codplama], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'plama_codplama',
            'plama_codplano',
            'plama_codtiplama',
            'plama_codrepositorio',
            'plama_titulo',
            'plama_valor',
            'plama_arquivo',
            'plama_tipomaterial',
            'plama_observacao',
        ],
    ]) ?>

</div>
