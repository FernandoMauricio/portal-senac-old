<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Despesasdocente */

$this->title = $model->doce_id;
$this->params['breadcrumbs'][] = ['label' => 'Despesasdocentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despesasdocente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->doce_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->doce_id], [
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
            'doce_id',
            'doce_descricao',
            'doce_valor',
            'doce_dsr',
            'doce_planejamento',
            'doce_produtividade',
            'doce_valorhoraaula',
            'doce_status',
        ],
    ]) ?>

</div>
