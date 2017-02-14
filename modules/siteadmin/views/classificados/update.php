<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\siteadmin\models\Classificados */

$this->title = 'Atualizar Listagem de Classificados: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Classificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'edital_id' => $model->edital_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="classificados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
