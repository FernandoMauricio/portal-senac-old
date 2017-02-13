<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Materialconsumo */

$this->title = $model->matcon_cod;
$this->params['breadcrumbs'][] = ['label' => 'Materialconsumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materialconsumo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->matcon_cod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->matcon_cod], [
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
            'matcon_cod',
            'matcon_descricao',
            'matcon_tipo',
            'matcon_valor',
            'matcon_status',
        ],
    ]) ?>

</div>
