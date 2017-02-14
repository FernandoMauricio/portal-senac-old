<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Errata */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Erratas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="errata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id, 'edital_id' => $model->edital_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id, 'edital_id' => $model->edital_id], [
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
            'nomeErrata',
            'arquivoErrata',
            'data',
            'edital_id',
        ],
    ]) ?>

</div>
