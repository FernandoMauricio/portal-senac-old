<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoEstruturafisica */

$this->title = $model->planestr_cod;
$this->params['breadcrumbs'][] = ['label' => 'Plano Estruturafisicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-estruturafisica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->planestr_cod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->planestr_cod], [
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
            'planestr_cod',
            'planodeacao_cod',
            'estruturafisica_cod',
            'quantidade',
            'tipo',
        ],
    ]) ?>

</div>
