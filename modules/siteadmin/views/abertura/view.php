<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\models\Situacao;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Abertura */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Abertura de Vagas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>


<div class="abertura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id, 'estado_id' => $model->estado_id, 'status_id' => $model->status_id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'desc_abertura',
            [
                'attribute'=>'arquivo',
                'format'=>'raw',
                'value'=>Html::a($model->arquivo, "http://localhost/siteadmin/web/" . $model->arquivo, ['id' => $model->id, 'target'=> '_blank']),
            ],
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y'],
            ],
            [
            'label' => 'Situação',
            'attribute' => 'situacao.descricao',
            ],
            [
            'label' => 'Publicação no site',
            'attribute' => 'status.descricao',
            ],
            'unidades',
        ],
    ]) ?>

        <?= $this->render('pdf', [
        'model' => $model,
        ]) ?>

</div>
