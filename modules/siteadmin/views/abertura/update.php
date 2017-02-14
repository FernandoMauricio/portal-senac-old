<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Abertura */

$this->title = 'Atualizar Abertura de Vaga: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Abertura de Vagas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'estado_id' => $model->estado_id, 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="abertura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
