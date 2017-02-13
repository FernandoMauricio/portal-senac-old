<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdminAcompanhamento */

$this->title = 'Update Manutencao Admin Acompanhamento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manutencao Admin Acompanhamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manutencao-admin-acompanhamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
