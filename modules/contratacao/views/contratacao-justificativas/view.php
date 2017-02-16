<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContratacaoJustificativas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contratacao Justificativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratacao-justificativas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
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
            'id',
            'descricao',
            'usuario',
            'id_contratacao',
        ],
    ]) ?>

</div>
