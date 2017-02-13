<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\ManutencaoAdminEncerradas */

$this->title = 'Update Manutencao Admin Encerradas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manutencao Admin Encerradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manutencao-admin-encerradas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
