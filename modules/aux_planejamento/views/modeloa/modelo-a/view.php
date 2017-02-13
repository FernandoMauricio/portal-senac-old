<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\modeloa\ModeloA */

$this->title = $model->moda_codmodelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelo As', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-a-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->moda_codmodelo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->moda_codmodelo], [
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
            'moda_codmodelo',
            'moda_codano',
            'moda_centrocusto',
            'moda_centrocustoreduzido',
            'moda_nomecentrocusto',
            'moda_codunidade',
            'moda_nomeunidade',
            'moda_codcolaborador',
            'moda_codusuario',
            'moda_nomeusuario',
            'moda_codsituacao',
            'moda_codentrada',
            'moda_codsegmento',
            'moda_codtipoacao',
            'moda_descriminacaoprojeto:ntext',
            'moda_identificacao',
        ],
    ]) ?>

</div>
