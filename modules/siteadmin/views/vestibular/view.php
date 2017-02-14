<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\vestibular\Vestibular */

$this->title = $model->idVest;
$this->params['breadcrumbs'][] = ['label' => 'Vestibular - Fatese', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vestibular-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idVest], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idVest',
            'descVest',
            [
                'attribute' => 'dataAbertura',
                'format' => ['date', 'php:d/m/Y'],
                'displayOnly'=>true,
            ],
            [
                'attribute' => 'dataEncerramento',
                'format' => ['date', 'php:d/m/Y'],
                'displayOnly'=>true,
            ],
            'curso',
            'vagas',
            'turno',
                [
                    'attribute'=>'status_id', 
                    'format'=>'raw',
                    'value'=>$model->status_id ?  '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>',
                ],
        ],
    ]) ?>

</div>
