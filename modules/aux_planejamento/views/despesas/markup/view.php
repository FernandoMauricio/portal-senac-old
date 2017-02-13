<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Markup */

$this->title = $model->mark_id;
$this->params['breadcrumbs'][] = ['label' => 'Markups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="markup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->mark_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->mark_id], [
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
            'mark_id',
            'mark_codunidade',
            'mark_ipca',
            'mark_reservatecnica',
            'mark_despesasede',
            'mark_totalincidencias',
            'mark_divisor',
        ],
    ]) ?>

</div>
