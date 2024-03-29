<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Comunicado */

$this->title = 'Atualizar Comunicado: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comunicados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'edital_id' => $model->edital_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comunicado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
