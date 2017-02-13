<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Centrocusto */

$this->title = 'Atualizar Centro de Custo: ' . $model->cen_codcentrocusto;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Centros de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cen_codcentrocusto, 'url' => ['view', 'id' => $model->cen_codcentrocusto]];
$this->params['breadcrumbs'][] = 'Atualizar ';
?>
<div class="centrocusto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'segmento' => $segmento,
        'tipoacao' => $tipoacao,
        'unidades' => $unidades,
        'anocentrocusto' => $anocentrocusto,
    ]) ?>

</div>
