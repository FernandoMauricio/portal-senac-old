<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\PlanoMaterial */

$this->title = 'Update Plano Material: ' . $model->plama_codplama;
$this->params['breadcrumbs'][] = ['label' => 'Plano Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->plama_codplama, 'url' => ['view', 'id' => $model->plama_codplama]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plano-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
