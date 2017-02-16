<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processo Seletivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-seletivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'numeroEdital',
            'descricao',
            'objetivo:ntext',
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y'],
            ],
            [
                'attribute' => 'data_encer',
                'format' => ['date', 'php:d/m/Y'],
            ],

            [
            'label' => 'Modalidade',
            'attribute' => 'modalidade.descricao',
            ],

            [
            'label' => 'Situação',
            'attribute' => 'situacao.descricao',
            ],

            [
                'attribute'=>'status_id', 
                'label'=>'Publicação no site?',
                'format'=>'raw',
                'value'=>$model->status_id ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>',
                'valueColOptions'=>['style'=>'width:100%']
            ],
     
        ],
    ]) ?>

        <?= $this->render('pdf', [
        'model' => $model,
        ]) ?>

</div>
