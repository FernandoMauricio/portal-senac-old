<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */

$this->title = 'Atualizar Processo Seletivo: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processos Seletivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="processo-seletivo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cargos' => $cargos,
    ]) ?>

</div>
