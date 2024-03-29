<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\comunicacaointerna\models\Destinocomunicacao */

$this->title = 'Update Destinocomunicacao: ' . ' ' . $model->dest_coddestino;
$this->params['breadcrumbs'][] = ['label' => 'Destinocomunicacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dest_coddestino, 'url' => ['view', 'id' => $model->dest_coddestino]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="destinocomunicacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
